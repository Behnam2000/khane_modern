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
