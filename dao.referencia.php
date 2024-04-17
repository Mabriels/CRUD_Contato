<?php

require_once("class.referencia.php");
require_once("conexao.php");

class DaoReferencia{
    public static $instancia;
    public function __construct(){
        //
    }
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            self::$instancia = new DaoReferencia();
        }
        return self::$instancia;
    }

    public function inserir(Referencia $ref){
        try{
            $sql = "INSERT INTO referencia(nome, telefone) VALUES 
                    (:nome, :telefone)";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $ref->getNome());
            $p_sql->bindValue(":telefone", $ref->getTelefone());
            $p_sql->execute();

            $sql = "INSERT INTO contato_referencia(codigo_contato, codigo_referencia) 
            VALUES (:codcontato, :codreferencia)";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":codcontato", $ref->getIdContato());
            $p_sql->bindValue(":codreferencia", Conexao::getConexao()->lastInsertId());
            $p_sql->execute();

            return 1;

        }catch(Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function editar(Referencia $ref){
        try{
            $sql = "UPDATE referencia SET nome = :nome, telefone = :telefone 
             WHERE codigo = :codigo";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":codigo", $ref->getCodigo());
            $p_sql->bindValue(":nome", $ref->getNome());
            $p_sql->bindValue(":telefone", $ref->getTelefone());
            return $p_sql->execute();
        }catch(Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function excluir(Referencia $ref){
        try{
            $sql = "DELETE FROM referencia WHERE codigo = :codigo";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":codigo", $ref->getCodigo());
            return $p_sql->execute();
        }catch(Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function listar(){
        try{
            $sql = "SELECT * FROM referencia";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);

            return $lista;
        }catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação,
            foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function listar_referencia_contato($id){
        try{
            $sql = "SELECT r.codigo, r.nome, r.telefone FROM referencia r 
            INNER JOIN contato_referencia cr 
            ON (cr.codigo_referencia = r.codigo) WHERE cr.codigo_contato = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_ASSOC);

        }catch (Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
            foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function pegar_referencia($id){
        try{
            $sql = "SELECT * FROM referencia WHERE codigo = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);

        }catch (Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
            foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }    
    
}