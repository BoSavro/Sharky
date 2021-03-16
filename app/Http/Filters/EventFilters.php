<?php

declare(strict_types=1);

namespace App\Http\Filters;


class EventFilters extends QueryFilter
{
    public function validFrom($value)
    {
        return $this->builder->where('valid_from', '>=', $value);
    }

    public function validTo($value)
    {
        return $this->builder->where('valid_from', '<=', $value);
    }
}
