<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UserRole;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    public function userRole() {
        return $this->hasMany(UserRole::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
}
