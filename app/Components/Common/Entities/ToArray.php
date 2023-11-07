<?php

namespace App\Components\Common\Entities;

trait ToArray
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toArrayOnly(array $allowed): array
    {
        return array_intersect_key($this->toArray(), array_flip($allowed));
    }
}
