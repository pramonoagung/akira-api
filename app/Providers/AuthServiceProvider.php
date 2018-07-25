<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Folklore\GraphQL\Error\AuthorizationError;

use Firebase\JWT\JWT;

use Thunderlabid\Otorisasi\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        /////////////
        // SESSION //
        /////////////
        $this->app['auth']->viaRequest('api', function ($request) {
            
            // Get Token
            $token = substr($request->header('authorization'), strlen('Bearer '));

            if ($token)
            {
                // Validate
                $jwt = JWT::decode($token, env('JWT_KEY'), ['HS256']);
                if ($jwt->iss !== env('JWT_ISS')) return null;
                if ($jwt->aud !== env('JWT_AUD')) return null;
                if (!$user = User::username($jwt->user_id)->first()) return null;

                return $user;
            }

            return null;
        });
    }
}
