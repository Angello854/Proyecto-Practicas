<?php

namespace App\Http\Controllers;

use App\Providers\Filament\DashboardPanelProvider;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect(Filament::getPanel('dashboard')->getPath());
    }
}
