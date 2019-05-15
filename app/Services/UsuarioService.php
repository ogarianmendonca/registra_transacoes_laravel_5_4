<?php

namespace App\Services;

use App\Entities\User;
use DB;

class UsuarioService
{

    public function __construct()
    {
    }

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

        //Salvar imagem
        $dados['imagem'] = $user->imagem;
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            if($user->imagem){
                $nImagem = $user->imagem;
            } else {
                $nImagem = $user->id . "_"  . kebab_case($user->name) . "_" . date('d_ m_ y');
            }

            $extensao = $request->imagem->extension();
            $nomeImagem = "{$nImagem}.{$extensao}";
            $dados['imagem'] = $nomeImagem ;

            $upload = $request->imagem->storeAs('users', $nomeImagem);

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload da imagem!');
            }
        }

        $retorno = $user->update($dados);

        return $retorno;
    }

}