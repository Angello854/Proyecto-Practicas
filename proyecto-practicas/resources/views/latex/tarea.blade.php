\documentclass[12pt,a4paper]{article}
\usepackage[utf8]{inputenc}
\usepackage[spanish]{babel}
\usepackage{geometry}
\usepackage{graphicx}
\usepackage{hyperref}
\usepackage{fancyhdr}
\usepackage{enumitem}
\usepackage{booktabs}
\usepackage{tabularx}
\usepackage{xcolor}

% Configuración de márgenes
\geometry{left=2.5cm,right=2.5cm,top=3cm,bottom=3cm}

% Configuración de encabezado y pie de página
\pagestyle{fancy}
\fancyhf{}
\renewcommand{\headrulewidth}{0.4pt}
\renewcommand{\footrulewidth}{0.4pt}
\fancyhead[L]{Tarea}
\fancyhead[R]{\today}
\fancyfoot[C]{\thepage}

\begin{document}

\begin{center}
\LARGE{\textbf{Tarea}}
\vspace{0.5cm}

\large{\textbf{Información de la Tarea}}
\vspace{0.3cm}
\end{center}

\section*{Detalles de la Tarea}

\begin{tabularx}{\textwidth}{|l|X|}
\hline
\textbf{Fecha} & {{ $record->fecha ? $record->fecha->format('d/m/Y') : 'No especificada' }} \\
\hline
\textbf{Horas} & {{ $record->horas ?? 'No especificado' }} \\
\hline
\textbf{Materiales} & {{ latex_escape($record->materiales ?? 'No especificado') }} \\
\hline
\end{tabularx}

\section*{Descripción}
{{ latex_format_multiline($record->descripcion ?? 'Sin descripción') }}

@if(!empty($record->aprendizaje))
    \section*{Aprendizaje}
    {{ latex_format_multiline($record->aprendizaje) }}
@endif

@if(!empty($record->refuerzo))
    \section*{Refuerzo}
    {{ latex_format_multiline($record->refuerzo) }}
@endif

@if(!empty($record->comentarios))
    \section*{Comentarios}
    {{ latex_format_multiline($record->comentarios) }}
@endif

@if($record->asignaturas && $record->asignaturas->count() > 0)
    \section*{Asignaturas}
    \begin{itemize}
    @foreach($record->asignaturas as $asignatura)
        \item {{ latex_escape($asignatura->nombre ?? 'Asignatura #' . $asignatura->id) }}
    @endforeach
    \end{itemize}
@endif

@if($record->usuario)
    \section*{Alumno}
    \begin{tabularx}{\textwidth}{|l|X|}
    \hline
    \textbf{Nombre} & {{ latex_escape($record->usuario->name) }} \\
    \hline
    \textbf{Email} & {{ latex_escape($record->usuario->email) }} \\
    \hline
    \end{tabularx}
@endif

\vspace{1cm}

\begin{center}
\textit{Documento generado automáticamente el \today}
\end{center}

\end{document}
