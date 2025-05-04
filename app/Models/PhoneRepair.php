<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneRepair extends Model
{
	use HasFactory;

	protected $guarded = ['id'];
	protected $fillable = [
		'phone_name',
		'repair_part_id',
		'description',
		'status',
		'user_id',
	];
	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	public function getRouteKeyName(): string
	{
		return 'id';
	}

	public function scopeSearch($query, $value): void
	{
		$query->where('phone_repairs.phone_name', 'like', "%{$value}%");
		// ->orWhere('phone_repairs.repair_parts', 'like', "%{$value}%");
	}
	/**
	 * Get the user that owns the Category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

}
