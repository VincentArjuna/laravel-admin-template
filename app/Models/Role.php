<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * @var array
     */
    protected $with = [
        'permissions'
    ];
}
