<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Passport\TokenRepository;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Revocar tokens existentes del usuario
        $this->revokeUserTokens($user->id);

        // Crear nuevo token de acceso personal
        $token = $user->createToken('auth-token');

        return response()->json([
            'user' => $user,
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => 60 * 24 * 15, // 15 días en segundos
        ]);
    }

    /**
     * Generate a token automatically without credentials
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateToken(Request $request)
    {
        // Buscar un usuario existente o crear uno por defecto
        $user = User::first();
        
        if (!$user) {
            return response()->json([
                'message' => 'No user found'
            ], 404);
        }

        // Crear nuevo token de acceso personal
        $token = $user->createToken('system-token');

        return response()->json([
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => 60 * 24 * 15, // 15 días en segundos
            'user' => $user,
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        
        if ($user) {
            // Revocar todos los tokens del usuario
            $this->revokeUserTokens($user->id);
        }

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Revocar todos los tokens de un usuario
     *
     * @param int $userId
     * @return void
     */
    private function revokeUserTokens($userId)
    {
        $tokenRepository = app(TokenRepository::class);

        // Revocar todos los tokens del usuario
        $tokens = $tokenRepository->forUser($userId);
        foreach ($tokens as $token) {
            $tokenRepository->revokeAccessToken($token->id);
        }
    }
}
