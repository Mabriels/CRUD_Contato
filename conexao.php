<?php
class Conexao{
    public static $conexao;
    //método construtor (executado automaticamente ao criar um objeto da classe)
    public function __construct(){
        //
    }
    public static function getConexao(){
        if(!isset(self::$conexao)){
            self::$conexao = new PDO("mysql:host=localhost;dbname=contatos"
            ,'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND
            => "SET NAMES utf8"));
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
            self::$conexao->setAttribute(PDO::ATTR_ORACLE_NULLS,
            PDO::NULL_EMPTY_STRING);
        }
        return self::$conexao;
    }
}
?>