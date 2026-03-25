<?php
require_once __DIR__ ."/config.php";
class Connect{
    protected $connection;

    function __construct(){
        $this->connectDatabase();
    }

    function connectDatabase(){
        try{
            $this->connection = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PASSWORD);
        }catch (PDOException $e){
            // throw new Exception("Erro ao conectar ao banco de dados.");
            die();    
        }
    }

    function getConnection(){
        return $this->connection;
    }
}