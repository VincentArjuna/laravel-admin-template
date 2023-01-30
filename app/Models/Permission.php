<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
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
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($permission) {
            Role::where('name', 'superuser')
                ->first()
                ->givePermissionTo($permission);
        });
    }
}
