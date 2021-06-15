<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Entities\Perfil;
use App\Services\UsuarioService;
use Illuminate\View\View;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    private $perfil;

    private $service;

    /**
     * UsuarioController constructor.
     * @param Perfil $perfil
     * @param UsuarioService $service
     */
    public function __construct(Perfil $perfil, UsuarioService $service)
    {
        $this->perfil = $perfil;
        $this->service = $service;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $usuarios = $this->service->getAll();

        return view('admin.usuario.index', compact('usuarios'));
    }

    /**
     * @return Factory|Application|View
     */
    public function perfil()
    {
        $perfis = $this->perfil->get()->pluck('no_perfil', 'id');
        
        return view('admin.usuario.perfil', compact('perfis'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function editarPerfil(Request $request)
    {
        $retorno = $this->service->editarPerfil($request->all(), $request);

        if($retorno){
            return redirect()->route('admin')->with('success', 'Pefil editado com sucesso!');
        } else{
            return redirect()->back()->with('error', 'Falha ao editar perfil!');
        }
    }
}
