<?php

namespace App\Providers;

use App\Custom\Passport\CustomToken;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::useTokenModel(CustomToken::class);
        Gate::define('edit-settings', function ($user) {
        	return $user;
		});
//        Passport::loadKeysFrom('./storage');

//        Custom time expired for token
//        Passport::tokensExpireIn(now()->addDays(15));
//        Passport::refreshTokensExpireIn(now()->addDays(30));
//        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

//        Custom model
//        Passport::useTokenModel(Token::class);
//        Passport::useClientModel(Client::class);
//        Passport::useAuthCodeModel(AuthCode::class);
//        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    }
}
