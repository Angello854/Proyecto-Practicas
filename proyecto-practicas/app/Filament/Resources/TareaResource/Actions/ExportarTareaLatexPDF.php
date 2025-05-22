<?php

namespace App\Filament\Resources\TareaResource\Actions;

use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Enums\Rol;
use ZipArchive;

class ExportarTareaLatexPDF extends Action
{
    public static function make(?string $name = 'exportar_pdf'): static
    {
        $action = parent::make($name);

        $action
            ->label('Exportar PDF')
            ->icon('heroicon-o-document-arrow-down')
            ->visible(fn () => getUserRol() !== Rol::Alumno)
            ->action(function ($record) {
                return self::generarPDF($record);
            });

        return $action;
    }

    /**
     * Crea una acción bulk para exportar múltiples tareas como PDF
     */
    public static function makeBulk(?string $name = 'exportar_pdf_bulk'): BulkAction
    {
        return BulkAction::make($name)
            ->label('Exportar PDF')
            ->icon('heroicon-o-document-arrow-down')
            ->visible(fn () => getUserRol() !== Rol::Alumno)
            ->action(function ($records) {
                // Si solo hay un registro, utilizar la exportación simple
                if ($records->count() === 1) {
                    return self::generarPDF($records->first());
                }

                $tempDir = storage_path('app/latex');
                $zipFilename = 'tareas_' . now()->format('YmdHis') . '.zip';
                $zipPath = "{$tempDir}/{$zipFilename}";

                // Asegurar que el directorio exista
                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0755, true);
                }

                // Crear un archivo ZIP
                $zip = new ZipArchive();
                if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                    Notification::make()
                        ->title('Error al crear archivo ZIP')
                        ->danger()
                        ->send();
                    return;
                }

                $pdfFiles = [];
                $errorCount = 0;
                $counter = [];

                // Generar PDF para cada registro
                foreach ($records as $record) {
                    try {
                        $nombreAlumno = self::normalizeNombre($record);
                        $tareaCount = isset($counter[$nombreAlumno]) ? ++$counter[$nombreAlumno] : ($counter[$nombreAlumno] = 1);

                        // Añadir contador solo si hay más de una tarea para este alumno
                        $suffix = $tareaCount > 1 ? "_" . $tareaCount : "";
                        $filename = 'tarea_' . $nombreAlumno . $suffix;

                        $pdfPath = self::generarPDFInterno($record, $filename);

                        if ($pdfPath && file_exists($pdfPath)) {
                            $zip->addFile($pdfPath, basename($pdfPath));
                            $pdfFiles[] = $pdfPath; // Guardar para borrar después
                        } else {
                            $errorCount++;
                        }
                    } catch (\Exception $e) {
                        Log::error('Error al generar PDF para tarea ID ' . $record->id . ': ' . $e->getMessage());
                        $errorCount++;
                    }
                }

                $zip->close();

                // Limpiar archivos PDF individuales
                foreach ($pdfFiles as $pdfFile) {
                    @unlink($pdfFile);
                }

                if ($errorCount > 0) {
                    Notification::make()
                        ->title("Exportación completada con {$errorCount} errores")
                        ->warning()
                        ->send();
                } else {
                    Notification::make()
                        ->title('Exportación completada con éxito')
                        ->success()
                        ->send();
                }

                return response()->download($zipPath, $zipFilename)->deleteFileAfterSend(true);
            });
    }

    /**
     * Normaliza y sanea el nombre del alumno para usarlo en nombre de archivo
     */
    private static function normalizeNombre($record)
    {
        if (!$record->usuario) {
            return 'sin_alumno';
        }

        $nombre = $record->usuario->name;

        // Transliterar caracteres acentuados (á -> a, é -> e, etc)
        $nombreNormalizado = Str::ascii($nombre);

        // Reemplazar espacios y otros caracteres no deseados con guiones bajos
        $nombreSanitizado = preg_replace('/[^a-zA-Z0-9_]/', '_', $nombreNormalizado);

        // Evitar nombres de archivo vacíos
        if (empty($nombreSanitizado)) {
            return 'alumno_' . $record->usuario->id;
        }

        return $nombreSanitizado;
    }

    /**
     * Genera un PDF para un solo registro
     */
    private static function generarPDF($record)
    {
        $nombreAlumno = self::normalizeNombre($record);
        $filename = 'tarea_' . $nombreAlumno;

        $pdfPath = self::generarPDFInterno($record, $filename);

        if (!$pdfPath) {
            return null;
        }

        return response()->download($pdfPath, "{$filename}.pdf")->deleteFileAfterSend(true);
    }

    /**
     * Lógica interna para generar el PDF
     *
     * @return string|null Ruta al archivo PDF generado o null si falla
     */
    private static function generarPDFInterno($record, $filename)
    {
        $tempDir = storage_path('app/latex');
        $texPath = "{$tempDir}/{$filename}.tex";

        // Asegurar que el directorio exista
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Renderizar la plantilla LaTeX
        try {
            $latex = view('latex.tarea', ['record' => $record])->render();
            file_put_contents($texPath, $latex);
        } catch (\Exception $e) {
            Log::error('Error al generar el template LaTeX: ' . $e->getMessage());
            Notification::make()
                ->title('Error al generar el template LaTeX')
                ->danger()
                ->body('Error: ' . $e->getMessage())
                ->send();
            return null;
        }

        // Configurar correctamente el entorno para Windows
        $env = [];
        if (PHP_OS_FAMILY === 'Windows') {
            // Asegurar que PATH incluya el directorio de MiKTeX
            $miktexPath = 'C:\\Users\\Administrador\\AppData\\Local\\Programs\\MiKTeX\\miktex\\bin\\x64';
            $path = getenv('PATH');

            if (!str_contains($path, $miktexPath)) {
                $env['PATH'] = "{$miktexPath};" . $path;
            }

            // Configurar HOME para que MiKTeX sepa dónde buscar archivos temporales
            $env['HOME'] = getenv('USERPROFILE') ?: getenv('HOMEPATH');
            $env['TEXINPUTS'] = $tempDir . '//;';
            $env['TEMP'] = sys_get_temp_dir();
            $env['TMP'] = sys_get_temp_dir();
        }

        // Cambiar al directorio temporal antes de ejecutar pdflatex
        $currentDir = getcwd();
        chdir($tempDir);

        // Ejecutar pdflatex con opciones para modo no interactivo y más detalles
        try {
            $process = Process::timeout(60)
                ->env($env)
                ->run("pdflatex -interaction=nonstopmode -halt-on-error -file-line-error \"{$filename}.tex\"");

            // Registra la salida para diagnóstico
            Log::debug("Salida de pdflatex: " . $process->output());

            if (!$process->successful()) {
                // Intentar leer el archivo de log de LaTeX
                $logPath = "{$tempDir}/{$filename}.log";
                $logContent = file_exists($logPath) ? file_get_contents($logPath) : 'Archivo de log no encontrado';

                Log::error("Error al ejecutar pdflatex: " . $process->errorOutput());
                Log::error("Contenido del log de LaTeX:\n{$logContent}");

                Notification::make()
                    ->title('Error al generar el PDF')
                    ->danger()
                    ->body("Error en la compilación LaTeX. Por favor revise la sintaxis de la plantilla.")
                    ->persistent()
                    ->send();

                // Volver al directorio original
                chdir($currentDir);
                return null;
            }
        } catch (\Exception $e) {
            chdir($currentDir);
            Log::error('Error al ejecutar pdflatex: ' . $e->getMessage());
            Notification::make()
                ->title('Error al ejecutar pdflatex')
                ->danger()
                ->body('Error: ' . $e->getMessage())
                ->send();
            return null;
        }

        // Volver al directorio original
        chdir($currentDir);

        // Verificar que el PDF existe
        $pdfPath = "{$tempDir}/{$filename}.pdf";
        if (!file_exists($pdfPath)) {
            Notification::make()
                ->title('Error al generar el PDF')
                ->danger()
                ->body('No se pudo encontrar el archivo PDF generado')
                ->send();
            return null;
        }

        // Limpiar archivos auxiliares
        foreach (['aux', 'log', 'out'] as $ext) {
            $auxFile = "{$tempDir}/{$filename}.{$ext}";
            if (file_exists($auxFile)) {
                @unlink($auxFile);
            }
        }

        // También podríamos eliminar el archivo .tex si no es necesario conservarlo
        if (file_exists($texPath)) {
            @unlink($texPath);
        }

        return $pdfPath;
    }
}
