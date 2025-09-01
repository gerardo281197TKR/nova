<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;

class fakerRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:faker-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate fake roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newRole = new Role();
        $newRole->name = "Admin";
        $newRole->save();

        $newRole = new Role();
        $newRole->name = "Manager";
        $newRole->save();

        $newRole = new Role();
        $newRole->name = "User";
        $newRole->save();
    }
}
