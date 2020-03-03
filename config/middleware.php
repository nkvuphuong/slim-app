<?php
declare(strict_types=1);

use App\Middlewares\LogMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(new LogMiddleware($app->getContainer()));
};
