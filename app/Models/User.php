<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

use App\Models\ACL\Funcao;
use App\Models\ACL\FuncaoPessoa;
use App\Models\ACL\Permissao;
use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Caixa;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //|||||||||||||||||||||||||||||||||||||||||||||||||   A C L   |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function isAdminSystem($admin)
    {
        // dd('isAdminSystem', $admin);
        return $this->kjahdkwkbewtoip->contains('nome', $admin);
    }

    // O Gate verifica permissão por permissão na hora de saber se possui o daquele item que ele pretende entrar
    public function temPermissao()
    {
        return $this->kjahdkwkbewtoip->map->yxwbgtooplyjjaz->flatten()->pluck('nome');
    }

    public function pacoteFuncao($funcoes)
    {
        // dd('pacoteFuncao', $funcoes);
        if( is_array($funcoes) || is_object($funcoes) )
        {
            return !! $funcoes->intersect($this->kjahdkwkbewtoip)->count();
        }
        return $this->kjahdkwkbewtoip->contains('nome', $funcoes);
    }


    //|||||||||||||||||||||||||||||||||||||||||||||||||   RELACIONAMENTOS   |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function kjahdkwkbewtoip()
    {
        return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
    }

    public function sdfjsefbdjfhufe()
    {
        return $this->belongsTo(Pessoa::class, 'id', 'id');
    }

    //|||||||||||||||||||||||||||||||||||||||||||||||||   MUTATOS   |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getPhotoAttribute()
    {
        if( $this->profile_photo_path )
        {
            return url('storage/'. $this->profile_photo_path );
        }
        else
        {
            return asset('imgs/no-image.png');
        }
    }

    //|||||||||||||||||||||||||||||||||||||||||||||||||   AUXILIARES   ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    
    public static function procurar($pesquisa)
    {
        return empty($pesquisa)
        ? static::query()
        : static::query()->where('name', 'LIKE', '%'.$pesquisa.'%')
        ->orWhere('email', 'LIKE', '%'.$pesquisa.'%');
    }


    //|||||||||||||||||||||||||||||||||||||||||||||||||   CAIXAS       ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    
    public function abcde()
    {
      return $this->hasMany(Caixa::class, 'id_usuario_abertura', 'id')->where('dt_abertura', '>=', \Carbon\Carbon::today())->where('status', '=', 'Aberto');
    }

}
