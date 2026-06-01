<?php

declare(strict_types=1);

function vd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value);
}

function redirectTo(string $path)
{
    header("Location: {$path}");
    http_response_code(302);
    exit();
}

function picUrl(string $filename): string
{
    return '/storage/pics/' . rawurlencode($filename);
}

function starRating(?int $rating): string
{
    $rating = max(0, min(5, (int) $rating));

    return str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
}
