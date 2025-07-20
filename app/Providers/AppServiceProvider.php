<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\Helpers\BuildMessageBag;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    use JsonResponseTrait;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(7)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function (Request $request, array $headers) {
                    $errors = [
                        'limit' =>  ["Please wait {$headers['Retry-After']} seconds before trying again"]
                    ];
                    $filledBag = $this->createAndFillMessageBag(errors: $errors);
                    return $this->respond(
                        state: false,
                        message: 'Too many requests attempted',
                        data: [],
                        errors: $filledBag->toArray(),
                        status: 429
                    );
                });
        });
    }

    /**
     * 
     */
    private function createAndFillMessageBag(array $errors): MessageBag
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
