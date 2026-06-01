<?php

declare(strict_types=1);

use Config\Database as DatabaseConfig;
use Config\Paths;
use Core\Container;
use Core\Controller;
use Core\Database;
use Model\AdminService;
use Model\PicService;
use Model\ReviewService;
use Model\UserService;
use Model\ValidatorService;

$dbConfig = DatabaseConfig::config();

return [
    Database::class => fn() => new Database(
        $dbConfig['driver'],
        [
            'host'   => $dbConfig['host'],
            'port'   => $dbConfig['port'],
            'dbname' => $dbConfig['dbname'],
        ],
        $dbConfig['username'],
        $dbConfig['password']
    ),
    Controller::class       => fn() => new Controller(Paths::VIEWS),
    ValidatorService::class => fn() => new ValidatorService(),
    UserService::class      => fn(Container $c) => new UserService($c->get(Database::class)),
    ReviewService::class    => fn(Container $c) => new ReviewService($c->get(Database::class)),
    PicService::class       => fn(Container $c) => new PicService($c->get(Database::class)),
    AdminService::class     => fn(Container $c) => new AdminService(
        $c->get(ReviewService::class),
        $c->get(PicService::class),
        $c->get(UserService::class)
    ),
];
