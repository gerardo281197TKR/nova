<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CiclesController extends Controller
{
    public function new(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Ciclos', 'url' => "/cicles/list", 'icon' => 'layers-outline'],
            ['title' => 'Nuevo', 'url' => '/cicles/new', 'icon' => 'add-circle-outline'] // página actual
        ];

        return view("cicles.new", compact('breadcrumbs'));
    }

    public function list(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Ciclos', 'url' => "/cicles/list", 'icon' => 'layers-outline'], // página actual
        ];

        return view("cicles.list", compact('breadcrumbs'));
    }
}
