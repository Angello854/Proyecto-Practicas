<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;

class DocumentacionController extends Controller
{
    public function index()
    {
        $docsPath = base_path('documentation');
        $indexUrl = url()->current();

        $files = collect(File::allFiles($docsPath))
            ->filter(fn($file) => $file->getExtension() === 'md')
            ->map(function ($file) use ($docsPath, $indexUrl) {
                $relativePath = str_replace($docsPath . DIRECTORY_SEPARATOR, '', $file->getRealPath());
                $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);

                return [
                    'name' => $relativePath,
                    'url' => route('documentacion.ver', [
                        'file' => $relativePath,
                        'index_url' => $indexUrl
                    ]),
                ];
            })
            ->toArray();

        return view('documentacion.index', compact('files'));
    }

    /**
     * Ver un documento específico
     */
    public function show($file)
    {
        $path = base_path('documentation/' . $file);

        abort_unless(File::exists($path), 404);

        $markdown = File::get($path);
        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($markdown);

        $indexUrl = request()->query('index_url', route('documentacion.index'));

        return view('documentacion.show', [
            'html' => $html,
            'fileName' => $file,
            'indexUrl' => $indexUrl
        ]);
    }
}
