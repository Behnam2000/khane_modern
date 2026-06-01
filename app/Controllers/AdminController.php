<?php

declare(strict_types=1);

namespace Controllers;

use Config\Paths;
use Core\Controller;
use Model\{AdminService, ValidatorService, UserService};

class AdminController
{
    public function __construct(
        private Controller $view,
        private ValidatorService $validatorService,
        private AdminService $adminService,
        private UserService $userService
    ) {}

    public function index()
    {
        echo $this->view->render('admin/index.php', [
            'title' => 'پنل مدیریت',
            'stats' => $this->adminService->dashboardStats(),
        ]);
    }

    public function reviews()
    {
        echo $this->view->render('admin/reviews.php', [
            'title'   => 'مدیریت نظرات',
            'reviews' => $this->adminService->reviews()->all(),
        ]);
    }

    public function reviewAction()
    {
        $reviewId = (int) ($_POST['review_id'] ?? 0);
        $action = $_POST['action'] ?? '';

        if ($reviewId <= 0) {
            redirectTo('/admin/reviews');
        }

        if ($action === 'approve') {
            $this->adminService->reviews()->updateStatus($reviewId, 'approved');
            $_SESSION['success'] = 'نظر تأیید شد.';
        } elseif ($action === 'reject') {
            $this->adminService->reviews()->updateStatus($reviewId, 'rejected');
            $_SESSION['success'] = 'نظر رد شد.';
        } elseif ($action === 'respond') {
            $response = trim($_POST['response'] ?? '');

            if ($response !== '') {
                $this->adminService->reviews()->respond(
                    $reviewId,
                    (int) $_SESSION['user'],
                    $response
                );
                $_SESSION['success'] = 'پاسخ شما ثبت شد.';
            }
        } elseif ($action === 'delete') {
            $this->adminService->reviews()->delete($reviewId);
            $_SESSION['success'] = 'نظر حذف شد.';
        }

        redirectTo('/admin/reviews');
    }

    public function users()
    {
        echo $this->view->render('admin/users.php', [
            'title' => 'مدیریت کاربران',
            'users' => $this->adminService->users()->all(),
        ]);
    }

    public function deleteUser()
    {
        $userId = (int) ($_POST['user_id'] ?? 0);

        if ($userId > 0) {
            $this->adminService->users()->delete($userId);
            $_SESSION['success'] = 'کاربر حذف شد.';
        }

        redirectTo('/admin/users');
    }

    public function pics()
    {
        echo $this->view->render('admin/pics.php', [
            'title' => 'مدیریت نمونه‌کارها',
            'pics'  => $this->adminService->pics()->all(),
        ]);
    }

    public function uploadPic()
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);

        if ($title === '' || empty($_FILES['image']['tmp_name'])) {
            $_SESSION['errors'] = ['image' => ['عنوان و تصویر الزامی است.']];
            redirectTo('/admin/pics');
        }

        $file = $_FILES['image'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowed, true)) {
            $_SESSION['errors'] = ['image' => ['فرمت تصویر مجاز نیست.']];
            redirectTo('/admin/pics');
        }

        $filename = uniqid('pic_', true) . '.' . $extension;
        $destination = Paths::SOURCE . 'storage/pics/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            $_SESSION['errors'] = ['image' => ['آپلود تصویر با خطا مواجه شد.']];
            redirectTo('/admin/pics');
        }

        $this->adminService->pics()->create(
            $filename,
            $title,
            $description !== '' ? $description : null,
            (int) $_SESSION['user'],
            $sortOrder
        );

        $_SESSION['success'] = 'تصویر جدید اضافه شد.';
        redirectTo('/admin/pics');
    }

    public function updatePic()
    {
        $picId = (int) ($_POST['pic_id'] ?? 0);

        if ($picId <= 0) {
            redirectTo('/admin/pics');
        }

        $this->adminService->pics()->update(
            $picId,
            trim($_POST['title'] ?? ''),
            trim($_POST['description'] ?? '') ?: null,
            (int) ($_POST['sort_order'] ?? 0),
            isset($_POST['is_active'])
        );

        $_SESSION['success'] = 'تصویر به‌روزرسانی شد.';
        redirectTo('/admin/pics');
    }

    public function deletePic()
    {
        $picId = (int) ($_POST['pic_id'] ?? 0);

        if ($picId > 0) {
            $pic = $this->adminService->pics()->findById($picId);

            if ($pic) {
                $filePath = Paths::SOURCE . 'storage/pics/' . $pic['filename'];

                if (is_file($filePath)) {
                    unlink($filePath);
                }

                $this->adminService->pics()->delete($picId);
            }

            $_SESSION['success'] = 'تصویر حذف شد.';
        }

        redirectTo('/admin/pics');
    }
}
