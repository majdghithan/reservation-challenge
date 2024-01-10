<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::global-search.after',
            fn (): View => view('filament.watch-tutorial'),
        );

        FilamentView::registerRenderHook(
            'panels::sidebar.footer',
            fn (): View => view('filament.sidebar-footer'),
        );

        FilamentView::registerRenderHook(
            'panels::footer',
            fn (): View => view('filament.appbar-footer'),
        );
    }
}
