<?php

require __DIR__ . "/../../vendor/autoload.php";

use Core\App;
use Config\Paths;
use function Routes\addRoutes;
use function Config\registerMiddleware;

$app = new App(Paths::SOURCE . "app/Middleware/container_definitions.php");

addRoutes($app);
registerMiddleware($app);

return $app;
