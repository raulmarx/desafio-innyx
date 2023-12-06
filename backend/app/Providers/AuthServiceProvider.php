<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user, $permissions) {
            // Verifica se há uma interseção entre as permissões do usuário e as necessárias
            if ($user->permissions()->intersect($permissions)->isNotEmpty()) {
                return true; // Permite acesso se houver uma interseção
            }
        
            return false; // Impede o acesso por padrão
        });
        
    }
}
