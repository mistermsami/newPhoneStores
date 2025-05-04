<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairParts extends Model
{
	use HasFactory;

	protected $gaurded = ['id'];
	protected $fillable = ['name', 'user_id'];

	public function scopeSearch($query, $search)
	{
		return $query->where('name', 'like', '%' . $search . '%');
	}
}
