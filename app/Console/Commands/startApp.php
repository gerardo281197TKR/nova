<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;

class startApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to the first installation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate:fresh');
        $this->info('migraciones realizadas');
        Artisan::call('faker:useradmin');
        $this->info('faker data instalada');
        $this->info('Da enter para terminar');
        Artisan::call('passport:client', [
            '--personal' => true
        ]);
        $this->info('passport creado');
        $this->info('Instalación terminada');
    }
}
