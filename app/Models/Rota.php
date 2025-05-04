<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rota extends Model
{
    use HasFactory;
    protected $table = 'rota';
    protected $primaryKey = 'rota_id';
    protected $fillable = [
        'user_id',
        'city_id',
        'region_id',
        'address_id',
        'date_assigned',
        'rota_status',
        'rotavisit_image',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function Cities()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'city_id');
    }
    public function Regions()
    {
        return $this->belongsTo('App\Models\Regions', 'region_id', 'region_id');
    }
    public function Addresses()
    {
        return $this->belongsTo('App\Models\Addresses', 'address_id', 'address_id');
    }
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->whereHas('User', function ($query) use ($term) {
                $query->where('name', 'LIKE', '%' . $term . '%'); // Searching in the user name field
            });
        });
    }
}
