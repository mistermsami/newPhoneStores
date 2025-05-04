<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
	use HasFactory;

	protected $guarded = [
		'id',
	];

	protected $fillable = [
		'sub_category_name',
		'category_id',
	];

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	public function subcategory()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}
	public function scopeSearch($query, $value): void
	{
		$query->where('sub_category_name', 'like', "%{$value}%");
	}

	public function getRouteKeyName(): string
	{
		return 'id';
	}

	/**
	 * Get the user that owns the Category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

}
