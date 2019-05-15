<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Entities\Saldo;
use App\Entities\HistoricoTransacao;
use App\Entities\Perfil;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'perfil_id', 'imagem'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Recupera o perfil do usuario 
     */
    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id', 'perfil_id');
    }

    /**
     * Recupera da tabela de saldos os saldos vinculados ao usuario
     */
    public function saldo()
    {
        return $this->hasOne(Saldo::class, 'usuario_id');
    }

    /**
     * Recuperar da tabela de historico transacao os historicos de regarcas e saques do usuario
     */
    public function historico()
    {
        return $this->hasMany(HistoricoTransacao::class, 'usuario_id');
    }
}
