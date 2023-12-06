<?php

namespace App\Observers\ACL;

use App\Models\ACL\Permissao;

class PermissaoObserver
{
    /**
     * Handle the Permissao "created" event.
     */
    public function created(Permissao $permissao): void
    {
        dd(111111111111, 'created');
        if(1==1)
        {
            cache()->forget('ACL::Permissao');
        }
    }

    /**
     * Handle the Permissao "updated" event.
     */
    public function updated(Permissao $permissao): void
    {
        dd(111111111111, 'updated');
        if(1==1)
        {
            cache()->forget('ACL::Permissao');
        }
    }

    /**
     * Handle the Permissao "deleted" event.
     */
    public function deleted(Permissao $permissao): void
    {
        dd(111111111111, 'deleted');
        if(1==1)
        {
            cache()->forget('ACL::Permissao');
        }
    }

    /**
     * Handle the Permissao "restored" event.
     */
    public function restored(Permissao $permissao): void
    {
        dd(111111111111, 'restored');
        if(1==1)
        {
            cache()->forget('ACL::Permissao');
        }
    }

    /**
     * Handle the Permissao "force deleted" event.
     */
    public function forceDeleted(Permissao $permissao): void
    {
        dd(111111111111, 'forceDeleted');
        if(1==1)
        {
            cache()->forget('ACL::Permissao');
        }
    }
}
