<?php
declare(strict_types=1);


use DI\Container;

return function (Container $container) {
    $dbSettings = $container->get('settings')['db'];
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($dbSettings);
    $capsule->bootEloquent();
    $capsule->setAsGlobal();
    return $capsule;
};
