<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Role extends Model
{
    protected $fillable = [
        'name', 'label'
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    public function permissions() {

        return $this->belongsToMany(\App\Permission::class);
    }

    public function getCreatedAtAttribute($value) {

        return Carbon::parse($value)->format('d/m/Y');
    }
}
