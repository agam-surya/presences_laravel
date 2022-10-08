<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function PermissionType(){
        return $this->belongsTo(PermissionType::class, 'permission_type_id');
    }
}
