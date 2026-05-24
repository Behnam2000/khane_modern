<?php

require __DIR__ . "/../../vendor/autoload.php";

use Core\App;
use function Routes\addRoutes;

$app = new App();

addRoutes($app);

return $app;
