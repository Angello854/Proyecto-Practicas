<?php

if (!function_exists('latex_escape')) {
    /**
     * Escapa caracteres especiales de LaTeX en una cadena
     *
     * @param string|null $string Texto a escapar
     * @return string Texto escapado para LaTeX
     */
    function latex_escape(?string $string): string
    {
        if ($string === null) {
            return '';
        }

        $replacements = [
            '\\' => '\\textbackslash{}',
            '{' => '\\{',
            '}' => '\\}',
            '&' => '\\&',
            '#' => '\\#',
            '_' => '\\_',
            '%' => '\\%',
            '~' => '\\textasciitilde{}',
            '^' => '\\textasciicircum{}',
            '<' => '\\textless{}',
            '>' => '\\textgreater{}',
            '|' => '\\textbar{}',
            '"' => '\\textquotedbl{}',
        ];

        // Primero reemplazamos los caracteres especiales
        $text = strtr($string, $replacements);

        return $text;
    }
}

if (!function_exists('latex_format_multiline')) {
    /**
     * Función auxiliar para formatear correctamente un texto con saltos de línea en LaTeX
     *
     * @param string|null $text Texto a formatear
     * @return string Texto formateado para LaTeX
     */
    function latex_format_multiline(?string $text): string
    {
        if ($text === null) {
            return '';
        }

        // Escapar el texto primero
        $text = latex_escape($text);

        // Reemplazar saltos de línea por \par para mejor formato en LaTeX
        $text = str_replace(["\r\n", "\n", "\r"], "\n\n\\par ", $text);

        return $text;
    }
}
