<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;
    protected $table = 'regions';
    protected $primaryKey = 'region_id';
    protected $fillable = [
        'city_id',
        'region_name',
    ];

    public function Cities()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'city_id');
    }
}
