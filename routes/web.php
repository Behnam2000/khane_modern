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
    TermsController
};
use Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};


function addRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/about', [AboutController::class, 'about']);

    $app->get('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'loginSubmit'])->add(GuestOnlyMiddleware::class);

    $app->get('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'registerSubmit'])->add(GuestOnlyMiddleware::class);

    $app->post('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);

    $app->get('/chideman', [ChidemanController::class, 'index']);

    $app->get('/kadamat', [KadamatController::class, 'index']);

    $app->get('/maghalat', [MaghalatController::class, 'index']);

    $app->get('/material', [MaterialController::class, 'index']);

    $app->get('/nazarat', [NazaratController::class, 'index']);
    $app->post('/nazarat', [NazaratController::class, 'addComment'])->add(AuthRequiredMiddleware::class);

    $app->get('/nemoneh', [NemonehController::class, 'index']);

    $app->get('/rang', [RangController::class, 'index']);

    $app->get('/terms', [TermsController::class, 'index']);

    addAdminRoutes($app);
}
