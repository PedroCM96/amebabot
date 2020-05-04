<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = [
        'name', 'kill_actions', 'kill_reasons', 'is_dead', 'war_id'
    ];
}
