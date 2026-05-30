<?php

declare(strict_types=1);

use Config\Paths;
use Core\Controller;
use Model\ValidatorService;

return [
    Controller::class => fn() => new Controller(Paths::VIEWS),
    ValidatorService::class => fn() => new ValidatorService()
];
