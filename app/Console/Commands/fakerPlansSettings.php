<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\CompanySettings;
use App\Models\PlansSettings;
use App\Models\Company;
use App\Models\Plan;

class fakerPlansSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:faker-plans-settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to start configs on plans';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newPlan = new Plan();
        $newPlan->name = "NOVA  1";
        $newPlan->description = "Plan básico para pequeñas empresas(Hasta 15 empleados).";
        $newPlan->cicleEvaluationsAvailables = 1;
        $newPlan->cicleEvaluationsUsersAvailables = 15;
        $newPlan->price = 3999;
        $newPlan->save();

        $newPlan = new Plan();
        $newPlan->name = "NOVA  2";
        $newPlan->description = "Plan intermedio para empresas medianas(Hasta 50 empleados).";
        $newPlan->cicleEvaluationsAvailables = 1;
        $newPlan->cicleEvaluationsUsersAvailables = 50;
        $newPlan->price = 6800;
        $newPlan->save();

        $newPlan = new Plan();
        $newPlan->name = "NOVA  3";
        $newPlan->description = "Plan avanzado para grandes empresas(Hasta 100 empleados).";
        $newPlan->cicleEvaluationsAvailables = 1;
        $newPlan->cicleEvaluationsUsersAvailables = 100;
        $newPlan->price = 11500;
        $newPlan->save();

        $newPlan = new Plan();
        $newPlan->name = "NOVA  4";
        $newPlan->description = "Plan avanzado para grandes empresas(hasta 300 empleados).";
        $newPlan->cicleEvaluationsAvailables = 1;
        $newPlan->cicleEvaluationsUsersAvailables = 300;
        $newPlan->price = 15999;
        $newPlan->save();

        $newCompany = new Company();
        $newCompany->planId = 1;
        $newCompany->name = 'Nueva Compañía';
        $newCompany->direction = 'Dirección de la nueva compañía';
        $newCompany->phoneContact = '1234567890';
        $newCompany->rfc = 'RFC123456789';
        $newCompany->employees = 15;
        $newCompany->status = 'active';
        $newCompany->save();

        $newCompanySettings = new CompanySettings();
        $newCompanySettings->companyId = $newCompany->id;
        $newCompanySettings->key = 'plan_id';
        $newCompanySettings->value = $newPlan->id;
        $newCompanySettings->save();

        $newCompanySettings = new CompanySettings();
        $newCompanySettings->companyId = $newCompany->id;
        $newCompanySettings->key = 'employees';
        $newCompanySettings->value = $newCompany->employees;
        $newCompanySettings->save();
    }
}
