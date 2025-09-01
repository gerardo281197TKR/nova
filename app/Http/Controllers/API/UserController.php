<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class UserController extends Controller
{
    /**
     * Register a new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Crear token de acceso personal
        $token = $user->createToken('auth-token');

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => 60 * 24 * 15, // 15 días en segundos
        ], 201);
    }

    /**
     * Get authenticated user information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function show(Request $request)
    {
        $user = auth()->user();
        $search = (string) $request->input("searchv","");

        $users = User::where("companyId",$user->companyId)
        ->whereNotIn("id",[$user->id])
        ->when($search, function($query) use ($search) {
            $query->where(function($q) use ($search) {
                $q->where("firstName","LIKE","%".$search."%")
                  ->orWhere("lastName","LIKE","%".$search."%")
                  ->orWhere("email","LIKE","%".$search."%");
            });
        })
        ->paginate(20);

        return responseApi(array(
            "status"  => true,
            "message" => null,
            "users"   => $users
        ));
    }
}
