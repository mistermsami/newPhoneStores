<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'region_id',
        'rota_address',
        'postcode',
    ];

    public function Regions()
    {
        return $this->belongsTo('App\Models\Regions', 'region_id', 'region_id');
    }
}
