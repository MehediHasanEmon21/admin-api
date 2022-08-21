<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeDesc($query)
    {
        return $query->orderBy('id','desc');
    }

    public function scopeAsc($query)
    {
        return $query->orderBy('id','asc');
    }

}
