<?php

namespace App\Console\Commands;

use App\War;
use Illuminate\Console\Command;

class CreateWar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amebabot:create-war';

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
    $name = $this->ask('¡Bienvenido a Amebabot! Así que deseas crear una nueva guerra... ¡De acuerdo! ¿Podrías indicarme el nombre que quieres darle a esta guerra?');
    $kill_messages = $this->ask("Has elegido '$name' como nombre de esta guerra. Ahora pasemos a configurarla. Introduce, separado por comas, los mensajes que saldrán cuando un personaje acabe con otro. (Ej: ha matado a, ha acabado con, ha asesinado a...");

    $kill_messages = explode(',', $kill_messages);
    $kill_messages = array_map('trim', $kill_messages);

    $kill_messages = json_encode($kill_messages);
    $this->comment('Creando guerra...');
    War::create([
        'name' => $name,
        'kill_messages' => $kill_messages,
        'is_finished' => false
    ]);

    $this->comment("¡La guerra se ha creado con éxito!, pero, de momento, no tiene jugadores. Comienza creando jugadores llamado al comando php artisan amebabot:create-player");
    }
}
