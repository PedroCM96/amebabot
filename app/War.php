<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class War extends Model
{
    protected $table = 'wars';

    protected $fillable = [
        'name', 'kill_messages', 'players_alive', 'day_number', 'is_finished'
    ];
}
