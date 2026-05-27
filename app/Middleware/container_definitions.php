<?php

declare(strict_types=1);

use Config\Paths;
use Core\Controller;


return [
    Controller::class => fn() => new Controller(Paths::VIEWS)
];
