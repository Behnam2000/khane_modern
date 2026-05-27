<?php

declare(strict_types=1);

namespace Contracts;

interface MiddlewareContract
{
    public function process(callable $callback);
}
