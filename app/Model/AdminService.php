<?php

declare(strict_types=1);

namespace Model;

class AdminService
{
    public function __construct(
        private ReviewService $reviewService,
        private PicService $picService,
        private UserService $userService
    ) {}

    public function dashboardStats(): array
    {
        $reviews = $this->reviewService->all();
        $pendingReviews = array_filter($reviews, fn(array $review) => $review['status'] === 'pending');

        return [
            'users'          => count($this->userService->all()),
            'reviews'        => count($reviews),
            'pendingReviews' => count($pendingReviews),
            'pics'           => count($this->picService->all()),
        ];
    }

    public function reviews(): ReviewService
    {
        return $this->reviewService;
    }

    public function pics(): PicService
    {
        return $this->picService;
    }

    public function users(): UserService
    {
        return $this->userService;
    }
}
