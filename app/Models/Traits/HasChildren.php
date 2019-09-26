<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;

Trait HasChildren {
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
}
