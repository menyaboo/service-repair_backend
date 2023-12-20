<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    protected $fillable = ["message", "user_id", "type_id", "status_id"];
    protected $hidden = [];

    public function status(){
        return $this->belongsTo(StatusService::class);
    }

    public function type(){
        return $this->belongsTo(TypeService::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
