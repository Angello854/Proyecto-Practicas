# Documentation: ExportarTareaLatexPDF.php

Original file: `app/Filament\Resources\TareaResource\Actions\ExportarTareaLatexPDF.php`

# ExportarTareaLatexPDF Documentation

Table of Contents:
=====================

1. [Introduction](#introduction)
2. [ExportarTareaLatexPDF Class](#exportartarelatexpdf-class)
3. [make Method](#make-method)
4. [generarPDF Method](#generarpdf-method)
5. [normalizeNombre Method](#normalizennombre-method)
6. [generarPDFInterno Method](#generarpdfinterno-method)

Introduction
============

The ExportarTareaLatexPDF class is responsible for generating PDF files for tasks in the system. This documentation provides an overview of the class, its methods, and how they work together to achieve this functionality.

ExportarTareaLatexPDF Class
===========================

This class extends the `Action` class from Filament and defines two main methods: `make` and `generarPDF`.

### make Method

The `make` method is used to create an action that exports a single task as a PDF file. The method takes an optional string parameter `$name`, which defaults to 'exportar_pdf'. The method returns an instance of the `Action` class.

Here is the implementation:
```php
public static function make(?string $name = 'exportar_pdf'): static
{
    $action = parent::make($name);

    // Define the action's label, icon, and visibility
    $action
        ->label('Exportar PDF')
        ->icon('heroicon-o-document-arrow-down')
        ->visible(fn () => getUserRol() !== Rol::Alumno)
        ->action(function ($record) {
            return self::generarPDF($record);
        });

    return $action;
}
```
### generarPDF Method

The `generarPDF` method generates a PDF file for a single task record. The method takes a `$record` parameter, which represents the task to be exported. The method returns a response instance that contains the generated PDF file.

Here is the implementation:
```php
/**
 * Genera un PDF para un solo registro
 */
private static function generarPDF($record)
{
    // Normalize the student's name and create a filename for the PDF
    $nombreAlumno = self::normalizeNombre($record);
    $filename = 'tarea_' . $nombreAlumno;

    // Generate the PDF file using the `generarPDFInterno` method
    $pdfPath = self::generarPDFInterno($record, $filename);

    if (!$pdfPath) {
        return null;
    }

    return response()->download($pdfPath, "{$filename}.pdf")->deleteFileAfterSend(true);
}
```
### normalizeNombre Method

The `normalizeNombre` method normalizes and sanitizes the student's name for use in the PDF file's filename. The method takes a `$record` parameter, which represents the task to be exported.

Here is the implementation:
```php
/**
 * Normaliza y sanea el nombre del alumno para usarlo en nombre de archivo
 */
private static function normalizeNombre($record)
{
    // Normalize and sanitize the student's name
    $nombre = $record->usuario ? $record->usuario->name : 'sin_alumno';
    $nombreNormalizado = Str::ascii($nombre);
    $nombreSanitizado = preg_replace('/[^a-zA-Z0-9_]/', '_', $nombreNormalizado);

    // Return the sanitized name
    return $nombreSanitizado;
}
```
### generarPDFInterno Method

The `generarPDFInterno` method generates a PDF file for a single task record. The method takes two parameters: `$record`, which represents the task to be exported, and `$filename`, which is the filename of the generated PDF file.

Here is the implementation:
```php
/**
 * Lógica interna para generar el PDF
 *
 * @return string|null Ruta al archivo PDF generado o null si falla
 */
private static function generarPDFInterno($record, $filename)
{
    // Define the temporary directory and the LaTeX template path
    $tempDir = storage_path('app/latex');
    $texPath = "{$tempDir}/{$filename}.tex";

    // Ensure the temporary directory exists
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0755, true);
    }

    // Render the LaTeX template and save it to a file
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

    // Configure the environment for Windows
    $env = [];
    if (PHP_OS_FAMILY === 'Windows') {
        // Ensure PATH includes the MiKTeX directory
        $miktexPath = 'C:\\Users\\Administrador\\AppData\\Local\\Programs\\MiKTeX\\miktex\\bin\\x64';
        $path = getenv('PATH');

        if (!str_contains($path, $miktexPath)) {
            $env['PATH'] = "{$miktexPath};" . $path;
        }

        // Set HOME for MiKTeX to find temporary files
        $env['HOME'] = getenv('USERPROFILE') ?: getenv('HOMEPATH');
        $env['TEXINPUTS'] = $tempDir . '//;';
        $env['TEMP'] = sys_get_temp_dir();
        $env['TMP'] = sys_get_temp_dir();
    }

    // Change to the temporary directory before running pdflatex
    $currentDir = getcwd();
    chdir($tempDir);

    // Run pdflatex with options for non-interactive mode and more details
    try {
        $process = Process::timeout(60)
            ->env($env)
            ->run("pdflatex -interaction=nonstopmode -halt-on-error -file-line-error \"{$filename}.tex\"");

        // Register the output for diagnosis
        Log::debug("Salida de pdflatex: " . $process->output());

        if (!$process->successful()) {
            // Try to read the LaTeX log file
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

            // Return to the original directory
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

    // Return the generated PDF file
    $pdfPath = "{$tempDir}/{$filename}.pdf";
    if (!file_exists($pdfPath)) {
        Notification::make()
            ->title('Error al generar el PDF')
            ->danger()
            ->body('No se pudo encontrar el archivo PDF generado')
            ->send();
        return null;
    }

    // Clean up auxiliary files
    foreach (['aux', 'log', 'out'] as $ext) {
        $auxFile = "{$tempDir}/{$filename}.$ext";
        if (file_exists($auxFile)) {
            @unlink($auxFile);
        }
    }

    // Also, we could remove the .tex file if it's not necessary to keep
    if (file_exists($texPath)) {
        @unlink($texPath);
    }

    return $pdfPath;
}
```
Note that this documentation focuses on the functionality of the `ExportarTareaLatexPDF` class and its methods. For more information on the underlying technologies, such as LaTeX or PHP, please refer to their respective documentation.