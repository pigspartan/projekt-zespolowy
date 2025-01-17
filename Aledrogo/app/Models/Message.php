<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'message',
        'read_at',
    ];
    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}
public function recipient()
{
    return $this->belongsTo(User::class, 'recipient_id');
}
}
