<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoTransacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_transacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id');
            /**
             * R => Recarga
             * S => Sacar
             * T => Transacao
             */
            $table->enum('tp_transacao', ['R', 'S', 'T']);
            $table->double('tot_quantia', 10, 2);
            $table->double('tot_depois', 10, 2);
            $table->double('tot_anterior', 10, 2);
            $table->integer('usuario_transferencia_id')->nullable();
            $table->date('dt_transacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_transacoes');
    }
}
