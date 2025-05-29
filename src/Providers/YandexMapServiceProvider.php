<?php

declare(strict_types=1);

namespace Gyrobus\MoonshineYandexMap\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class YandexMapServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'moonshine-ymap');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'moonshine-ymap');

        $this->publishes([
            __DIR__ . '/../../config/moonshine-yandex-map.php' => config_path('moonshine-yandex-map.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/moonshine-ymap'),
        ], ['moonshine-map-assets', 'laravel-assets']);
    }
}