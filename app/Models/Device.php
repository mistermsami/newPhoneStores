<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
	use HasFactory;
	protected $gaurded = ['id'];
	protected $fillable = [
		'name',
		'user_id'
	];

	public function scopeSearch($query, $value): void
	{
		$query->where('name', 'like', "%{$value}%");

	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
