<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'path',
        'price',
        'payment_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function flaggedByUsers()
    {
        return $this->belongsToMany(User::class, 'flagged_listings')
            ->withPivot('reason')
            ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}
