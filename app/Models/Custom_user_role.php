<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom_user_role extends Model
{
    public function user()
    {
        return $this->belongsTo(Custom_user::class, 'userId');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }
}
