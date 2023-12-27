<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class followup extends Model
{
    use HasFactory;
    protected $fillable = [
        'followup_date',
        'followup_type',
        'note',
        'article',
        'conference',
        'email',
        'name',
        'followup_created_date'
        
       
    ];
}
