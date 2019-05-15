<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected  $table = 'tb_perfil';

    protected $fillable = [
        'no_perfil',
        'st_ativo'
    ];
    
}
