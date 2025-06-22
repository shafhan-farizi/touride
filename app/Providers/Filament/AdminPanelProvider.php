<?php

namespace App\Providers\Filament;

use App\Http\Middleware\IsAdmin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\View\LegacyComponents\Widget;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('6.5rem')
            ->favicon(asset('images/logo.png'))
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            // ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
                \App\Filament\Resources\ManageCarsResource\Pages\ManageCars::class,
                // \App\Filament\Resources\BookingResource\Pages\ManageBookings::class,
                \App\Filament\Pages\Dashboard::class,
                \App\Filament\Pages\Reports::class,

            ])
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                \App\Filament\Widgets\WelcomeMessage::class,
                \App\Filament\Widgets\Calendar::class,
                \App\Filament\Widgets\BookingSummary::class,
                \App\Filament\Widgets\CarsOverview::class,
                \App\Filament\Widgets\IncomeSummary::class,
                \App\Filament\Widgets\StatusCars::class,
                \App\Filament\Widgets\AddedCars::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('2s');
    }
    

    public function boot(): void
    {
        FilamentAsset::register([
            Css::make('jsCalendar.min', asset('css/jsCalendar.min.css')),
            Js::make('jsCalendar.min', asset('js/jsCalendar.min.js')),
            Js::make(
                'apexcharts',
                'https://cdn.jsdelivr.net/npm/apexcharts'
            ),
            Css::make('tailwind', 'https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css'),
        ]);
    }
}
