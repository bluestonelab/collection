<?php

namespace Bluestone\Collection;

use ArrayAccess;
use Countable;
use JsonSerializable;

class Collection implements ArrayAccess, Countable, JsonSerializable
{
    public function __construct(
        protected $items = []
    ) {
    }

    public function get($key, $default = null): string
    {
        return Arr::get($this->items, $key, $default);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): array
    {
        return array_map(function ($value) {
            return match(true) {
                $value instanceof JsonSerializable => $value->jsonSerialize(),
                default => $value,
            };
        }, $this->items);
    }
}
