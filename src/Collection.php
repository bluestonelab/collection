<?php

namespace Bluestone\Collection;

class Collection
{
    public function __construct(
        protected $items = []
    ) {
    }

    public function get($key, $default = null): string
    {
        return Arr::get($this->items, $key, $default);
    }
}
