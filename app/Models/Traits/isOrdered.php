<?php


namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;

trait isOrdered
{
    public function scopeOrdered(Builder $builder, $field = 'order', $direction = 'asc')
    {
        $builder->orderBy($field, $direction);
    }
}
