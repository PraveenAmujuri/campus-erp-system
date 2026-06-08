<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [

        'user_id',

        'type',

        'title',

        'message',

        'recipient',

        'status',

        'response',

        'sent_at'
    ];
}