<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use Filament\Facades\Filament as FacadesFilament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;


class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        FacadesFilament::serving(function () {

            if (auth()->user()) {
                // if (auth()->user()->admin === 1 && auth()->user()->hasAnyRole(['super-admin','admin'])) {

                //     FacadesFilament::registerUserMenuItems([
                //         UserMenuItem::make()
                //         ->label('Manage Users')
                //         ->url(UserResource::getUrl())
                //         ->icon('heroicon-o-users'),]);
                // }
            }


        });
    }
}
