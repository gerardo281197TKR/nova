<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function new(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/", 'icon' => 'home-outline'],
            ['title' => 'Usuarios', 'url' => "/users/list", 'icon' => 'person-outline'],
            ['title' => 'Nuevo', 'url' => '/users/new', 'icon' => 'add-circle-outline'] // página actual
        ];

        return view("users.new", compact('breadcrumbs'));
    }

    public function list(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/", 'icon' => 'home-outline'],
            ['title' => 'Usuarios', 'url' => "/users/list", 'icon' => 'person-outline'], // página actual
        ];

        return view("users.list", compact('breadcrumbs'));
    }

    public function profile(Request $request) {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/", 'icon' => 'home-outline'],
            ['title' => 'Usuarios', 'url' => "/users/list", 'icon' => 'person-outline'],
            ['title' => 'Perfil', 'url' => "/users/profile", 'icon' => 'person-outline'], // página actual
        ];

        return view("users.profile", compact('breadcrumbs'));
    }
}
