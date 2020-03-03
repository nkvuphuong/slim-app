<?php
declare(strict_types=1);

use App\Controllers\UserController;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $jwtAuth = $app->getContainer()->get('jwt_auth');

    $app->group('/users', function (Group $group) {
        $controllerClass = UserController::class;
        $group->get('', [$controllerClass, 'index']);
        $group->get('/{id}', [$controllerClass, 'find']);
    })->add($jwtAuth);
};
