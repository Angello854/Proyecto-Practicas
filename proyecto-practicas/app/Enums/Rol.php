<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Rol: string implements HasIcon, HasLabel, HasColor

{

    /*
     * Name = value
     */
    case Admin = 'admin';
    case Alumno = 'alumno';
    case TutorLaboral = 'tutor_laboral';
    case TutorDocente = 'tutor_docente';

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Alumno => 'Alumno',
            self::TutorLaboral => 'Tutor Laboral',
            self::TutorDocente => 'Tutor Docente',
        };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::Admin=> 'heroicon-o-shield-check',
            self::Alumno => 'heroicon-o-academic-cap',
            self::TutorLaboral, self::TutorDocente  => 'heroicon-o-user-circle',
        };
    }

    /**
     * @return array
     */
    public function getColor(): array
    {
        return match ($this) {
            self::Admin => Color::Red,
            self::Alumno => Color::Amber,
            self::TutorLaboral => Color::Green,
            self::TutorDocente => Color::Purple,
        };
    }


    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
            ->toArray();
    }

}
