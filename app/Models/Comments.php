<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'article',
        'country',
        'conference',
        'client_status_id',
        'comment',
        'comment_created_date',
        'comment_updated_date',
        'user_id'
       
    ];
}
