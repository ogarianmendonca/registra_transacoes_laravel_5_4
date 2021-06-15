<?php

namespace App\Services;

use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

/**
 * Class UsuarioService
 * @package App\Services
 */
class UsuarioService
{
    /**
     * UsuarioService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return User[]|Collection
     */
    public function getAll()
    {
        $usuarios = User::all();
        return $usuarios;
    }

    /**
     * @param $dados
     * @param $request
     * @return RedirectResponse
     */
    public function editarPerfil($dados, $request)
    {
        $user = auth()->user();

        if($dados['password'] != null){
            $dados['password'] = bcrypt($dados['password']);
        } else{
            unset($dados['password']);
        }

        if($dados['perfil_id'] != null){
            $dados['perfil_id'] = (int)$dados['perfil_id'];
        }

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $nImagem = $user->id . "_user_" . date('d_ m_ y');

            $extensao = $request->imagem->extension();
            $nomeImagem = "{$nImagem}.{$extensao}";
            $dados['imagem'] = $nomeImagem;

            $upload = $request->imagem->storeAs('upload/users', $nomeImagem);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload da imagem!');
            }
        }

        $retorno = $user->update($dados);

        return $retorno;
    }
}