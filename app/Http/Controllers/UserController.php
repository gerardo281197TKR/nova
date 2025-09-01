<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Show the form to create a new user
     */
    public function new()
    {
        // Verificar que el usuario autenticado sea manager
        if (auth()->user()->roleId !== Role::MANAGER) {
            abort(403, 'No tienes permisos para crear usuarios');
        }

        $company = auth()->user()->company;
        $roles = Role::where('id', '!=', Role::ADMIN)->get(); // No permitir crear admins

        // Verificar si la empresa puede agregar más usuarios
        if (!$company->canAddUser()) {
            return redirect()->route('company.plan')->with('error', 'Has alcanzado el límite de usuarios de tu plan. Actualiza tu plan para agregar más usuarios.');
        }

        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Usuarios', 'url' => "/users/list", 'icon' => 'person-outline'],
            ['title' => 'Nuevo Usuario', 'url' => '/users/new', 'icon' => 'add-circle-outline']
        ];

        return view('users.new', compact('company', 'roles', 'breadcrumbs'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        // Verificar que el usuario autenticado sea manager
        if (auth()->user()->roleId !== Role::MANAGER) {
            abort(403, 'No tienes permisos para crear usuarios');
        }

        $company = auth()->user()->company;

        // Verificar si la empresa puede agregar más usuarios
        if (!$company->canAddUser()) {
            return response()->json([
                'message' => 'Has alcanzado el límite de usuarios de tu plan',
                'errors' => ['plan' => 'Límite de usuarios alcanzado']
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'roleId' => 'required|exists:roles,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Verificar que no se esté creando un admin
        if ($request->roleId == Role::ADMIN) {
            return response()->json([
                'message' => 'No puedes crear usuarios administradores',
                'errors' => ['roleId' => 'Rol no permitido']
            ], 422);
        }

        try {
            $user = User::create([
                'roleId' => $request->roleId,
                'companyId' => $company->id,
                'uuid' => Str::uuid()->toString(),
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'Usuario creado exitosamente',
                'user' => $user,
                'company' => [
                    'currentUsers' => $company->getCurrentUsersCount(),
                    'maxUsers' => $company->plan->cicleEvaluationsUsersAvailables,
                    'remainingSlots' => $company->getRemainingUsersSlots()
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the list of users
     */
    public function list()
    {
        // Verificar que el usuario autenticado sea manager
        if (auth()->user()->roleId !== Role::MANAGER) {
            abort(403, 'No tienes permisos para ver la lista de usuarios');
        }

        $company = auth()->user()->company;
        $users = $company->users()->with('role')->get();

        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Usuarios', 'url' => "/users/list", 'icon' => 'person-outline']
        ];

        return view('users.list', compact('company', 'users', 'breadcrumbs'));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = auth()->user();
        $company = $user->company;
        
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => "/home", 'icon' => 'home-outline'],
            ['title' => 'Perfil', 'url' => "/users/profile", 'icon' => 'person-outline']
        ];

        return view('users.profile', compact('user', 'company', 'breadcrumbs'));
    }

    /**
     * Get company users info for API
     */
    public function getCompanyUsersInfo()
    {
        $company = auth()->user()->company;
        
        return response()->json([
            'company' => [
                'name' => $company->name,
                'plan' => [
                    'name' => $company->plan->name,
                    'maxUsers' => $company->plan->cicleEvaluationsUsersAvailables,
                    'price' => $company->plan->formatted_price
                ],
                'currentUsers' => $company->getCurrentUsersCount(),
                'remainingSlots' => $company->getRemainingUsersSlots(),
                'canAddUser' => $company->canAddUser()
            ]
        ]);
    }
}
