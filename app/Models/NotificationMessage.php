<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMessage extends Model
{
    use HasFactory;
    protected $fillable = ['receiver_id','sender_id', 'title', 'message', 'link', 'is_read'];
}
