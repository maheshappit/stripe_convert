<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferencesToday extends Model
{
    use HasFactory;

    protected $table='conferences_today';


    protected $fillable = [
        'name',
        'email',
        'article',
        'country',
        'conference',
        'user_id',
        'user_created_at',
        'user_updated_at',
        'email_sent_status',
        'email_sent_date',
        'client_status',
    ];
}
