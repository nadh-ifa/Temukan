<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'image',
        'description',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}