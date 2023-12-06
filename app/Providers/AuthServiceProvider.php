<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\User;
use App\Models\ACL\Permissao;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $permissoes = Permissao::with('dzjvxinawjwtnfa')->get();
        $permissoes = cache()->rememberForever(
                                            'acl::permissoes',
                                            fn() => Permissao::
                                                            with('dzjvxinawjwtnfa')->
                                                            get()
                                            );

        foreach ($permissoes as $key => $permissao)
        {
            Gate::define($permissao->nome, function(User $user) use ($permissao)
            {
                // dd($user, $permissao);
                return $user->temPermissao($permissao);
            });
        }

        Gate::before(function(User $user)
        {
            // if ($user->isAdminSystem('Administrador do Sistema'))
            if ($user->id == 2)
            {
                return true;
            }
        });
    }
}
