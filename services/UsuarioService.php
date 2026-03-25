<?php
require_once __DIR__ . "/../models/UsuarioModel.php";
class UsuarioService{
    private $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }

    public function login($username, $senha){
        if(empty($username) || empty($senha)){
            throw new Exception( "erro");
        }

        $resultado = $this->usuarioModel->login($username, $senha);

        if(!$resultado){
            throw new Exception("Email ou senha inválidos.");
        }

        // session?
        return $resultado;
    }
}