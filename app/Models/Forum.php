<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Forum extends Model
{
    protected $fillable = [
        'pergunta', 'user_id'
    ];

    public function user() {

        return $this->belongsTo(\App\User::class);
    }
    
    public function tag() {

        return $this->hasMany(\App\Models\ForumTag::class);
    }

    public function resposta() {

        return $this->hasOne(\App\Models\ForumResposta::class);
    }

    public function getCreatedAtAttribute($value) {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
