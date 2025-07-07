<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;
use App\Http\Requests\AuthRegisterRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = AppUser::query()
            ->where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $token = $user->createToken('main');
        return compact(['token']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ['status' => 'ok'];
    }

    public function register(AuthRegisterRequest $request)
    {
        $entity = AppUser::create($request->validated());
        return compact(['entity']);
    }

    public function password(Request $request)
    {
        $email = $request->input('email');
        $password_reset_token = $request->input('password_reset_token');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        $step = 'start';
        $user = null;
        $message = 'Informe o e-mail para redefinir a senha.';
        $message_type = 'info';

        if ($email) {
            $user = AppUser::query()
                ->where('email', $email)
                ->first();
        }

        if ($email && !$password_reset_token && !$password) {
            $step = 'email';
            $message = 'Informe o código enviado por e-mail. Informe-o no campo abaixo.';
            $message_type = 'info';
            $user->password_reset_token = $user->password_reset_token ??
                substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 2)), 0, 5);
        }

        if ($email && $password_reset_token && !$password) {
            $step = 'password_reset_token';
            $message = 'Informe a senha nova.';
            $message_type = 'info';
        }

        if ($email && $password_reset_token && $password) {
            $step = 'password';
            if ($password == $password_confirmation) {
                $message = 'Senha alterada';
                $message_type = 'success';
                $step = 'finish';
                $user->password = Hash::make($password);
                $user->password_reset_token = null;
                $user->save();
            } else {
                $message = 'As senhas não conferem.';
                $message_type = 'error';
            }
        }

        return compact(['step', 'message', 'message_type']);
    }
}
