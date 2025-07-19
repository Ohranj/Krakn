<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    use JsonResponseTrait;

    public function login(LoginRequest $request): JsonResponse
    {
        $isValidAttempt = Auth::attempt($request->validated());
        if (!$isValidAttempt) {
            //Put into laravel error?
            $errors = [
                'authenticate' => ['Unable to authenticate, please check and try again']
            ];
            return $this->respond(
                state: false,
                message: 'Invalid request',
                data: [],
                errors: $errors,
                status: 422
            );
        }

        $request->session()->regenerate();
        return $this->respond(state: true, message: 'Request success', data: [], errors: []);
    }
}
