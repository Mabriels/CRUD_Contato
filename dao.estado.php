<?php

require_once("class.estado.php");
require_once("conexao.php");

class DaoEstado{
    public static $instancia;
    public function __construct(){
        //
    }
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            self::$instancia = new DaoEstado();
        }
        return self::$instancia;
    }

    public function listar(){
        try{
            $sql = "SELECT * FROM estado ORDER BY nome ASC";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);

            return $lista;
        }catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação,
            foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    
}