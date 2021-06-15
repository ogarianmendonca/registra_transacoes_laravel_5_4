<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfil
 * @package App\Entities
 */
class Perfil extends Model
{
    protected  $table = 'perfis';

    protected $fillable = [
        'no_perfil',
        'st_ativo'
    ];
}
