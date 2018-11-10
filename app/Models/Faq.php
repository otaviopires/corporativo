<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Faq extends Model
{
    protected $fillable = [
        'pergunta'
    ];

    public function user() {

        return $this->belongsTo(\App\User::class);
    }
    
    public function tag() {

        return $this->hasMany(\App\Models\FaqTag::class);
    }

    public function resposta() {

        return $this->hasOne(\App\Models\FaqResposta::class);
    }

    public function getCreatedAtAttribute($value) {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
