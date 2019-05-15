<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Entities\User;

class HistoricoTransacao extends Model
{
    protected $table = 'historico_transacoes';

    protected $fillable = [
        'usuario_id',
        'tp_transacao',
        'tot_quantia',
        'tot_depois',
        'tot_anterior',
        'usuario_transferencia_id',
        'dt_transacao'
    ];
    
    /**
     * Formada a dt_transacao
     */
    public function getDtTransacaoAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Retorna os tipos de tp_transacao
     */
    public function tipo($tipo = null)
    {
        $tipos =[
            'R' => 'Recarga',
            'S' => 'Saque',
            'T' => 'Transferência'
        ];

        if(!$tipo){
            return $tipos;
        }

        if($this->usuario_transferencia_id != null && $tipo == 'R'){
            return 'Recebido';
        }

        return $tipos[$tipo];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_transferencia_id');
    }

}
