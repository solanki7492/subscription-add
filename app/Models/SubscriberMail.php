<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberMail extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_id',
        'post_id',
    ];
}
