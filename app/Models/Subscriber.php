<?php

namespace App\Models;
use App\Events\ConfirmSubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'email',
    ];
    
    protected $dispatchesEvents = [
        'created' => ConfirmSubscription::class,
    ];
}
