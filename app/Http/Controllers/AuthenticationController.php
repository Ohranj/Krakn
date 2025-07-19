<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BuildMessageBag;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    use JsonResponseTrait;

    /**
     * 
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $isValidAttempt = Auth::attempt($request->validated());
        if (!$isValidAttempt) {
            $errors = [
                'attempt' =>  ['Unable to authenticate, please check and try again']
            ];
            $filledBag = $this->createAndFillMessageBag($errors);
            return $this->respond(
                state: false,
                message: 'Invalid request',
                data: [],
                errors: $filledBag->toArray(),
                status: 422
            );
        }

        $request->session()->regenerate();
        return $this->respond(state: true, message: 'Request success', data: [], errors: []);
    }

    /**
     * 
     */
    private function createAndFillMessageBag($errors): MessageBag
    {
        $bag = new BuildMessageBag($errors);
        $bag->initialiseBag();
        foreach ($errors as $key => $value) {
            foreach ($value as $err) {
                $bag->addKeyValueToBag($bag, $key, $err);
            }
        }

        return $bag->bag;
    }
}
