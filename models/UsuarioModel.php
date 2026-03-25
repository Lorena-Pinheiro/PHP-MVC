<?php
require_once __DIR__ ."/../config/connect.php";
class UsuarioModel extends Connect{
    public function __construct(){}

    public function login($username, $senha){
        try{
            $query = $this->connection->prepare("SELECT * FROM USUARIO WHERE USERNAME = :username AND SENHA = :senha");
            $query->execute(array("USERNAME"=> $username,"SENHA"=> $senha));
            return $resultado = $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("DB Error: ".$e->getMessage());
        }
        // $query->bind_param("s", $username);
    }
}