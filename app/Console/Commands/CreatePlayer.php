<?php

namespace App\Console\Commands;

use App\Player;
use App\War;
use Illuminate\Console\Command;

class CreatePlayer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amebabot:create-player';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'amebabot description';

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
        $this->comment('¡Bienvenido a Amebabot!, para crear un personaje, primero tendrás que indicarnos a qué guerra pertenece. Estas son las guerras que tienes creadas:');
        $wars = War::all();
        foreach($wars as $war){
            $this->comment("- ID: {$war->id} , Nombre: {$war->name}");
        }

        // War_id and name
        $war_id = trim($this->ask("Así que por favor, indícanos la ID de la guerra a la que vas a incluir el personaje"));
        $name = trim($this->ask("Ahora, indícanos el nombre del jugador que quieres añadir."));

        //Kill actions
        $kill_actions = trim($this->ask("Bien, ahora indícanos, separado por comas, las acciones que cometerá el personaje al matar. Ej: con un calcetín sudado ($name ha matado a X con un calcetín sudado), atropellándolo con su BMW ($name ha matado a X atropellándolo con su BMW"));
        $kill_actions = explode(',', $kill_actions);
        $kill_actions = array_map('trim', $kill_actions);
        $kill_actions = json_encode($kill_actions);

        //Kill reasons
        $kill_reasons = trim($this->ask('Ya casi terminamos, ahora indica las razones, separadas con coma, por las que matará. Ej: le ha mirado mal, le ha asustado, le ha tirado la moto'));
        $kill_reasons = explode(',', $kill_reasons);
        $kill_reasons = array_map('trim', $kill_reasons);
        $kill_reasons = json_encode($kill_reasons);

        //Save in DB and finish the process
        $this->comment('¡Ya tenemos todos los datos! Espera un momento...');
        Player::create([
           'name' => $name,
           'kill_actions' => $kill_actions,
           'kill_reasons' => $kill_reasons,
           'is_dead' => false,
           'war_id' => $war_id
        ]);

    }
}
