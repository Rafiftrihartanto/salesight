<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $primaryKey = 'store_id';

    protected $fillable = [
        'user_id',
        'store_name',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
