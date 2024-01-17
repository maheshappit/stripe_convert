<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferencesData extends Model
{
    use HasFactory;

    
    protected $table='conferences_data';

    protected $fillable = [
        'name',
        'created_by',
        
    ];
}
