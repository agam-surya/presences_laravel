<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function permission(){
        return $this->hasMany(Permission::class);
    }
}
