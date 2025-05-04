<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'user_id',
        'expenses_category_id',
        'expenses_name',
        "expenses_amount",
        "expenses_date",
        "expenses_notes",
        "slug",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function expensecategory(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expenses_category_id');
    } 
    
    public function scopeSearch($query, $value): void
    {
        $query->where('expenses_name', 'like', "%{$value}%")
            ->orWhere('expenses_amount', 'like', "%{$value}%")
            ->orWhere('expenses_date', 'like', "%{$value}%")
            ->orWhere('slug', 'like', "%{$value}%");
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
