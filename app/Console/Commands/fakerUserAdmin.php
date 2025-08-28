<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Setting;
use App\Models\Role;
use App\Models\User;

use Ramsey\Uuid\Uuid;

use DB;

class fakerUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faker:useradmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start faker data as admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        DB::table('users')->delete();

        $originalUUid = Uuid::uuid4()->toString();
        $role_id = new Role();
        $role_id->name = 'Admin';
        $role_id->created_at = Carbon::now();
        $role_id->save();       

        $role_id = new Role();
        $role_id->name = 'Secretario';
        $role_id->created_at = Carbon::now();
        $role_id->save();       

        $role_id = new Role();
        $role_id->name = 'Cliente';
        $role_id->created_at = Carbon::now();
        $role_id->save();

        $user                    = new User();
        $user->roleId            = 1;
        $user->firstName         = 'luevanos';
        $user->lastName          = 'jimenez';
        $user->email             = 'admin@nova.com';
        $user->email_verified_at =  Carbon::now();
        $user->password          =  Hash::make('admin2025');
        $user->uuid              =  $originalUUid;
        $user->save();        

        $settings = new Setting();
        $settings->key = 'active_register';
        $settings->value = false;
        $settings->save();        

        $settings = new Setting();
        $settings->key = 'redirect_to';
        $settings->value = 'https://google.com';
        $settings->save();
    }
}
