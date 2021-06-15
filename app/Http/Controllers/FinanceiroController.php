<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\FinanceiroService;
use App\Entities\User;
use App\Entities\HistoricoTransacao;
use App\Http\Requests\FinanceiroFormRequest;
use Illuminate\View\View;

/**
 * Class FinanceiroController
 * @package App\Http\Controllers
 */
class FinanceiroController extends Controller
{
    private $service;

    private $entity;

    private $historico;

    private $totalPaginas = 3;

    /**
     * FinanceiroController constructor.
     * @param FinanceiroService $service
     * @param User $entity
     * @param HistoricoTransacao $historico
     */
    public function __construct(
        FinanceiroService $service,
        User $entity,
        HistoricoTransacao $historico
    ) {
        $this->service = $service;
        $this->entity = $entity;
        $this->historico = $historico;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        //Recupera os dados do usuario logado "auth()->user()"
        $saldo = auth()->user()->saldo;

        //Se  não existe nenhum valor o valor apresentado é zero(0)
        $saldo_total = $saldo ? $saldo->tot_quantia : 0;

        return view('admin.financeiro.index', compact('saldo_total'));
    }

    /**
     * @return Factory|Application|View
     */
    public function recarga()
    {
        return view('admin.financeiro.recarga');
    }

    /**
     * @param FinanceiroFormRequest $request
     * @return RedirectResponse
     */
    public function recarregar(FinanceiroFormRequest $request)
    {
        $retorno = $this->service->recarregar($request->valor);

        if($retorno['success']){
            return redirect()->route('admin.financeiro')->with('success', $retorno['mensagem']);            
        } else {
            return redirect()->back()->with('error', $retorno['mensagem']);
        }
    }

    /**
     * @return Factory|Application|View
     */
    public function saque()
    {
        return view('admin.financeiro.saque');
    }

    /**
     * @param FinanceiroFormRequest $request
     * @return RedirectResponse
     */
    public function sacar(FinanceiroFormRequest $request)
    {
        $retorno = $this->service->sacar($request->valor);

        if($retorno['success']){
            return redirect()->route('admin.financeiro')->with('success', $retorno['mensagem']);            
        } else {
            return redirect()->back()->with('error', $retorno['mensagem']);
        }
    }

    /**
     * @return Factory|Application|View
     */
    public function transfere()
    {
        return view('admin.financeiro.transfere');
    }

    /**
     * @param Request $request
     * @return Factory|Application|RedirectResponse|View
     */
    public function transferir(Request $request)
    {
        $usuario = $this->service->getUsuarioTransferencia($request->tranferir);

        $saldo = auth()->user()->saldo;

        if(!$usuario){
            return redirect()->back()->with('error', 'Usuário informado não foi encontrado!');            
        }

        if($usuario->id == auth()->user()->id){
            return redirect()->back()->with('error', 'Não pode tranferir para você mesmo!');            
        }

        return view('admin.financeiro.confirma-tranferencia', compact('usuario', 'saldo'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function confirmarTranferir(Request $request)
    {
        $destino = $this->entity->find($request->id_usuario_destino);

        if(!$destino){
            return redirect()->route('admin.financeiro.transfere')->with('error', 'Usuário não encontrado!');
        }

        $retorno = $this->service->transferir($request->valor, $destino);

        if($retorno['success']){
            return redirect()->route('admin.financeiro')->with('success', $retorno['mensagem']);            
        } else {
            return redirect()->back()->with('error', $retorno['mensagem']);
        }
    }

    /**
     * @return Factory|Application|View
     */
    public function historico()
    {
        $historicos = auth()->user()->historico()->paginate(5);
        $tipos = $this->historico->tipo();

        return view('admin.financeiro.historico', compact('historicos', 'tipos'));
    }

    /**
     * @param Request $request
     * @return Factory|Application|View
     */
    public function pesquisaHistorico(Request $request)
    {
        $dados = $request->except(['_token']);
        $historicos = $this->service->pesquisaHistorico($dados, $this->totalPaginas);
        $tipos = $this->historico->tipo();

        return view('admin.financeiro.historico', compact('historicos', 'tipos', 'dados'));
    }
}