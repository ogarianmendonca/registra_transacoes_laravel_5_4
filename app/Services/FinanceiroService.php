<?php

namespace App\Services;

use App\Entities\Saldo;
use App\Entities\User;
use App\Entities\HistoricoTransacao;
use DB;

class FinanceiroService
{
    private $saldo; 

    private $user;

    private $historico;

    public function __construct(Saldo $saldo, User $user, HistoricoTransacao $historico)
    {
        $this->saldo = $saldo;
        $this->user = $user;
        $this->historico = $historico;
    }

    public function recarregar($valor)
    {
        DB::beginTransaction();

        //Retorna dados do saldo atual do usuario logado
        $saldo = auth()->user()->saldo()->firstOrCreate([]);

        //Salva uma nova recarga
        $tot_quantia = $saldo->recarregar($valor);
        
        //Cria um novo registro de historico
        $historico = auth()->user()->historico()->create([
            'tp_transacao'  => 'R',
            'tot_quantia'   => $valor,
            'tot_depois'    => $tot_quantia['total_quantia'] ,
            'tot_anterior'  => $tot_quantia['total_antes'] ? $tot_quantia['total_antes'] : 0,
            'dt_transacao'  => date('Ymd'),
        ]);

        if($tot_quantia && $historico){
            DB::commit();

            return [
                'success' => true,
                'mensagem' => 'Recarga realizada com sucesso!'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'mensagem' => 'Falha ao recarregar!'
            ];
        }
    }

    public function sacar($valor)
    {
        //Retorna dados do saldo atual do usuario logado
        $saldo = auth()->user()->saldo()->firstOrCreate([]);

        if($valor > $saldo->tot_quantia){
            return [
                'success' => false,
                'mensagem' => 'Saldo insuficiente!'
            ];
        }

        DB::beginTransaction();

        //Retira o valor do saldo
        $tot_quantia = $saldo->sacar($valor);
        
        //Cria um novo registro de historico
        $historico = auth()->user()->historico()->create([
            'tp_transacao'  => 'S',
            'tot_quantia'   => $valor,
            'tot_depois'    => $tot_quantia['total_quantia'] ,
            'tot_anterior'  => $tot_quantia['total_antes'] ? $tot_quantia['total_antes'] : 0,
            'dt_transacao'  => date('Ymd'),
        ]);

        if($tot_quantia && $historico){
            DB::commit();

            return [
                'success' => true,
                'mensagem' => 'Saque realizado com sucesso!'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'mensagem' => 'Falha ao efetuar saque!'
            ];
        }
    }

    public function getUsuarioTransferencia($transferir)
    {
        $usuario = $this->user->where('name', 'LIKE', "%$transferir%")
                    ->orWhere('email', $transferir)
                    ->get()->first();

        return $usuario;
    }
    
    public function transferir($valor, $destino)
    {
        //Retorna dados do saldo atual do usuario logado
        $saldo = auth()->user()->saldo()->firstOrCreate([]);
        if($valor > $saldo->tot_quantia){
            return [
                'success' => false,
                'mensagem' => 'Saldo insuficiente!'
            ];
        }

        DB::beginTransaction();

        //Retira o valor da transferencia
        $tot_quantia = $saldo->sacar($valor);
        $historico = auth()->user()->historico()->create([
            'tp_transacao'  => 'T',
            'tot_quantia'   => $valor,
            'tot_depois'    => $tot_quantia['total_quantia'] ,
            'tot_anterior'  => $tot_quantia['total_antes'] ? $tot_quantia['total_antes'] : 0,
            'dt_transacao'  => date('Ymd'),
            'usuario_transferencia_id' => $destino->id
        ]);

        //Deposita o valor da transferencia
        $saldo_destino = $destino->saldo()->firstOrCreate([]);
        $tot_quantia_destino = $saldo->trasferirDestino($valor, $saldo_destino);
        $historico_destino = $destino->historico()->create([
            'tp_transacao'  => 'R',
            'tot_quantia'   => $valor,
            'tot_depois'    => $tot_quantia_destino['total_quantia'] ,
            'tot_anterior'  => $tot_quantia_destino['total_antes'] ? $tot_quantia_destino['total_antes'] : 0,
            'dt_transacao'  => date('Ymd'),
            'usuario_transferencia_id' => auth()->user()->id
        ]);

        if($tot_quantia && $historico && $historico_destino){
            DB::commit();

            return [
                'success' => true,
                'mensagem' => 'Transferêcia realizada com sucesso!'
            ];
        } 

        DB::rollback();
        return [
            'success' => false,
            'mensagem' => 'Falha ao efetuar saque!'
        ];
    }

    public function pesquisaHistorico($dados, $totalPaginas)
    {
        $retorno = $this->historico->where(function($query) use ($dados){
            if(isset($dados['id'])){
                $query->where('id', $dados['id']);
            }

            if(isset($dados['data'])){
                $query->where('dt_transacao', $dados['data']);
            }

            if(isset($dados['tipo'])){
                $query->where('tp_transacao', $dados['tipo']);
            }
        // })->toSql();
        })->where('usuario_id', auth()->user()->id)->paginate($totalPaginas);

        return $retorno;
    }

}