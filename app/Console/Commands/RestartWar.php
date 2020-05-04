<?php

namespace App\Console\Commands;

use App\Player;
use Illuminate\Console\Command;

class RestartWar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amebabot:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Player::where('is_dead', true)->update([
           'is_dead' => false
        ]);
    }
}
