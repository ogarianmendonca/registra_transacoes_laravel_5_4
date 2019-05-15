<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Perfil;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    private $perfil;

    private $service;

    public function __construct(Perfil $perfil, UsuarioService $service)
    {
        $this->perfil = $perfil;
        $this->service = $service;
    }

    /**
     * Metodo que retorna view de perfil
     */
    public function perfil()
    {
        $perfis = $this->perfil->get()->pluck('no_perfil', 'id');
        
        return view('admin.usuario.perfil', compact('perfis'));
    }

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
