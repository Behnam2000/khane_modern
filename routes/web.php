<?php

namespace Routes;

use Core\App;
use Controllers\{
    HomeController,
    AboutController,
    AuthController,
    ChidemanController,
    KadamatController,
    MaghalatController,
    MaterialController,
    NazaratController,
    NemonehController,
    RangController,
    RegisterController,
    TermsController
};


function addRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/about', [AboutController::class, 'about']);

    $app->get('/login', [AuthController::class, 'login']);
    $app->post('/login', [AuthController::class, 'loginSubmit']);

    $app->get('/register', [RegisterController::class, 'register']);
    $app->post('/register', [RegisterController::class, 'registerSubmit']);

    $app->get('/chideman', [ChidemanController::class, 'index']);

    $app->get('/kadamat', [KadamatController::class, 'index']);

    $app->get('/maghalat', [MaghalatController::class, 'index']);

    $app->get('/material', [MaterialController::class, 'index']);

    $app->get('/nazarat', [NazaratController::class, 'index']);

    $app->get('/nemoneh', [NemonehController::class, 'index']);

    $app->get('/rang', [RangController::class, 'index']);

    $app->get('/terms', [TermsController::class, 'index']);
}
