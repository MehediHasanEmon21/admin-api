<?php

namespace App\Models;

use App\Traits\ScopeTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, ScopeTraits;
    protected $guarded = [];

}
