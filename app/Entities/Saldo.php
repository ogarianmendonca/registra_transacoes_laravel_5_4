<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table = 'saldos';

    protected $fillable = [
        'usuario_id',
        'tot_quantia'
    ];

    /**
     * Na criação da tabela pelo migrations, não cria as colunas created_at e updated_at
     */
    public $timestamps = false;

    /**
     * Salva uma nova recarga somando a recarga que já existe no banco de dados
     */
    public function recarregar($valor)
    {
        //Recupera o tot_quantia do saldo do usuario logado
        $total_antes = $this->tot_quantia;

        //Soma o valor existente com o valor adicionado
        $this->tot_quantia += number_format($valor, 2, '.', '');

        //Atualiza o  registro da tabela saldo
        $this->save();

        $retorno = [
            'total_antes' => $total_antes,
            'total_quantia' => $this->tot_quantia
        ];

        return $retorno;
    }

    public function sacar($valor)
    {
        //Recupera o tot_quantia do saldo do usuario logado
        $total_antes = $this->tot_quantia;

        //Diminuui o valor existente com o valor sacado
        $this->tot_quantia -= number_format($valor, 2, '.', '');

        //Atualiza o  registro da tabela saldo
        $this->save();

        $retorno = [
            'total_antes' => $total_antes,
            'total_quantia' => $this->tot_quantia
        ];

        return $retorno;
    }

    public function trasferirDestino($valor, $saldo_destino)
    {
        //Recupera o tot_quantia do saldo do usuario logado
        $total_antes = $saldo_destino->tot_quantia;

        //Soma o valor existente com o valor adicionado
        $saldo_destino->tot_quantia += number_format($valor, 2, '.', '');

        //Atualiza o  registro da tabela saldo
        $saldo_destino->save();

        $retorno = [
            'total_antes' => $total_antes,
            'total_quantia' => $saldo_destino->tot_quantia
        ];

        return $retorno;
    }
}
