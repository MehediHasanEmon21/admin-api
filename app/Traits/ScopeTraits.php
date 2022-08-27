<?php

namespace App\Traits;

trait ScopeTraits{

    public function scopeDesc($query)
    {
        return $query->orderBy('id','desc');
    }

    public function scopeAsc($query)
    {
        return $query->orderBy('id','asc');
    }

}