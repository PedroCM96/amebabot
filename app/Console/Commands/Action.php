<?php

namespace App\Console\Commands;

use App\Player;
use App\War;
use Illuminate\Console\Command;

class Action extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amebabot:action';

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
        $wars = War::all();
        foreach( $wars as $war ){
            $players = Player::where('war_id', $war->id)->where('is_dead', false)->get()->toArray();
            if(sizeof($players) <= 1)
                continue;

            shuffle($players);
            $player_killer = array_shift($players);
            $player_killed = array_shift($players);

            $arr_kill_actions = json_decode($player_killer['kill_actions'], true);
            shuffle($arr_kill_actions);
            $kill_action = array_shift($arr_kill_actions);

            $arr_kill_reasons = json_decode($player_killer['kill_reasons'], true);
            shuffle($arr_kill_reasons);
            $kill_reason = array_shift($arr_kill_reasons);

            $this->comment("{$player_killer['name']} ha matado a {$player_killed['name']} $kill_action porque $kill_reason");

            Player::where('id', $player_killed['id'])->update([
                'is_dead' => true
            ]);

            $players_alive = Player::select('name')->where('is_dead', false)->where('war_id', $war->id)->get()->toArray();
            $players_dead =  Player::select('name')->where('is_dead', true)->where('war_id', $war->id)->get()->toArray();



            $this->comment("============================== Vivos: " . sizeof($players_alive) . "/" . (sizeof($players_alive) + sizeof($players_dead)) . "=====================================================");

            foreach($players_alive as $player){
                $this->comment($player['name']);
            }

            foreach($players_dead as $player){
                $this->error($player['name']);
            }


        }
    }

}



