<?php

namespace App\Livewire;

use Livewire\Component;

class VersionSwitcher extends Component
{
    public string $version = '1.0';

    public function updatedVersion($value)
    {
        // Puedes guardar en sesión, hacer filtros, etc.
        session(['version_seleccionada' => $value]);
    }

    public function render()
    {
        return view('livewire.version-switcher');
    }
}
