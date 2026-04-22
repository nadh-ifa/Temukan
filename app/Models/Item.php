<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'location',
        'date_event',
        'image',
        'status',
        'validated_by',
        'validated_at',
    ];

    protected function casts(): array
    {
        return [
            'date_event' => 'date',
            'validated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function proofImages()
    {
        return $this->hasMany(ProofImage::class);
    }
}