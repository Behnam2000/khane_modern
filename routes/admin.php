<?php

namespace Routes;

use Controllers\AdminController;
use Core\App;
use Middleware\AdminOnlyMiddleware;

function addAdminRoutes(App $app): void
{
    $admin = [AdminOnlyMiddleware::class];

    $app->get('/admin', [AdminController::class, 'index'], $admin);
    $app->get('/admin/reviews', [AdminController::class, 'reviews'], $admin);
    $app->post('/admin/reviews', [AdminController::class, 'reviewAction'], $admin);
    $app->get('/admin/users', [AdminController::class, 'users'], $admin);
    $app->post('/admin/users/delete', [AdminController::class, 'deleteUser'], $admin);
    $app->get('/admin/pics', [AdminController::class, 'pics'], $admin);
    $app->post('/admin/pics/upload', [AdminController::class, 'uploadPic'], $admin);
    $app->post('/admin/pics/update', [AdminController::class, 'updatePic'], $admin);
    $app->post('/admin/pics/delete', [AdminController::class, 'deletePic'], $admin);
}
