<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Quest extends Model
{
    protected $fillable = ['title', 'description', 'difficulty', 'xp_reward', 'gold_reward', 'client_id', 'admin_id', 'hunter_id', 'status', 'proof', 'proof_image'];

    public function client()
    {
        return $this->belongsTo(Custom_user::class, 'client_id');
    }
    public function admin()
    {
        return $this->belongsTo(Custom_user::class, 'admin_id');
    }
    public function hunter()
    {
        return $this->belongsTo(Custom_user::class, 'hunter_id');
    }
}

