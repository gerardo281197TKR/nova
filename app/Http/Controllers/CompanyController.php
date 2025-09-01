<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function plan(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Empresa', 'url' => "/company/plan", 'icon' => 'business-outline'], // página actual
        ];

        return view("company.plan", compact('breadcrumbs'));
    }

    public function payments(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Empresa', 'url' => "/company/payments", 'icon' => 'business-outline'], // página actual
        ];

        return view("company.payments", compact('breadcrumbs'));
    }
}
