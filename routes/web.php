<?php
Auth::routes();

Route::get('/', 'SiteController@index');

Route::group(['middleware' => ['auth']], function(){
    Route::get('admin', 'AdminController@index')->name('admin');

    /**
     * Rotas Usuário
     */
    Route::get('usuario/perfil', 'UsuarioController@perfil')->name('admin.usuario.perfil');

    Route::post('usuario/editar-perfil', 'UsuarioController@editarPerfil')->name('admin.usuario.editar-perfil');


    /**
     * Rotas Financeiro
     */
    Route::get('financeiro', 'FinanceiroController@index')->name('admin.financeiro');

    Route::get('financeiro/recarga', 'FinanceiroController@recarga')->name('admin.financeiro.recarga');
    Route::post('financeiro/recarregar', 'FinanceiroController@recarregar')->name('admin.financeiro.recarregar');

    Route::get('financeiro/saque', 'FinanceiroController@saque')->name('admin.financeiro.saque');
    Route::post('financeiro/sacar', 'FinanceiroController@sacar')->name('admin.financeiro.sacar');

    Route::get('financeiro/transfere', 'FinanceiroController@transfere')->name('admin.financeiro.transfere');
    Route::post('financeiro/transferir', 'FinanceiroController@transferir')->name('admin.financeiro.transferir');
    Route::post('financeiro/confirmar-tranferir', 'FinanceiroController@confirmarTranferir')->name('admin.financeiro.confirmar-tranferir');

    Route::get('financeiro/historico',  'FinanceiroController@historico')->name('admin.financeiro.historico');
    Route::any('financiero/pesquisa-historico', 'FinanceiroController@pesquisaHistorico')->name('admin.financeiro.pesquisa-historico');
});

