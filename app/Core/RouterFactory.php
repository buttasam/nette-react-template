<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList();

        $router->addRoute('api/notes/<id \d+>', [
            'presenter' => 'Notes',
            'action' => 'default',
            'id' => null
        ]);

        $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');
        return $router;
    }
}
