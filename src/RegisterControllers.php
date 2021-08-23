<?php

declare(strict_types=1);

namespace Bobdenotter\RssExtension;

use Symfony\Component\Routing\Route;

class RegisterControllers
{
    public static function getRoutes(): array
    {
        return [
            'rss_extension' => new Route(
                '/{type}/feed.{extension}',
                ['_controller' => 'Bobdenotter\RssExtension\Controller::feed'],
                [
                    'type' => '(rss|atom|json)',
                    'extension' => '(rss|atom|json|xml)',
                ]
            )
        ];
    }
}
