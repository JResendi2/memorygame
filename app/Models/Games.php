<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Games extends Model
{
    use HasFactory;
    protected $fillable = ['player_id', 'start_time', 'end_time'];

    public function player():BelongsTo 
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
