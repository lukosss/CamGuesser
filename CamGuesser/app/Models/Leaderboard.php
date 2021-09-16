<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{

    use HasFactory;

    protected $fillable = [
        'player_name',
        'score',
        'game_mode',
    ];

    public static function get()
    {
    }

}
