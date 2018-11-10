<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Og extends Model
{
    public function scopeString($query, $protocolo) {
		return $query->where('protocolo', $protocolo);
	}
}
