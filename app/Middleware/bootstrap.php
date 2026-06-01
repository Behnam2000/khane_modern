<?php

require __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/env_helper.php";

loadEnv(dirname(__DIR__, 2) . '/.env');

use Core\App;
use Config\Paths;

use function Routes\addRoutes;
use function Config\registerMiddleware;

require Paths::SOURCE . 'routes/admin.php';


$app = new App(Paths::SOURCE . "app/Middleware/container_definitions.php");

addRoutes($app);
registerMiddleware($app);

return $app;
