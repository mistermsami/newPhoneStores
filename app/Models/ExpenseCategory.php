<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseCategory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [
        'id',
    ];
 
    protected $fillable = [
        'user_id',
        'expenses_category_name', 
        'slug', 
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class, 'expenses_category_id', 'id');
    } 
    
    public function scopeSearch($query, $value): void
    {
        $query->where('expenses_category_name', 'like', "%{$value}%");
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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
