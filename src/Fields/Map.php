<?php

namespace Gyrobus\MoonshineYandexMap\Fields;

use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Fields\Image;

class Cropper extends Image
{
    protected string $view = 'moonshine-ymap::fields.map';

    public function assets(): array
    {
        return [
            //Css::make('vendor/moonshine-cropper/css/moonshine-cropper.css'),
            Js::make('https://api-maps.yandex.ru/2.1/?apikey='.config('moonshine-yandex-map.apikey').'&lang='.app()->getLocale() . '_' . str(app()->getLocale())->upper()),
            Js::make('/vendor/moonshine-ymap/js/ymap-init.js'),
        ];
    }

    protected function viewData(): array
    {
        $data = parent::viewData();

        return $data;
    }
}