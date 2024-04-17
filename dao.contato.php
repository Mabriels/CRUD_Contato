<?php

require_once("class.contato.php");
require_once("conexao.php");

class DaoContato{
    public static $instancia;
    public function __construct(){
        //
    }
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            self::$instancia = new DaoContato();
        }
        return self::$instancia;
    }

    public function inserir(Contato $contato){
        try{
            $sql = "INSERT INTO contato(nome, telefone, email, codigo_estado) VALUES 
                    (:nome, :telefone, :email, :codestado)";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $contato->getNome());
            $p_sql->bindValue(":telefone", $contato->getTelefone());
            $p_sql->bindValue(":email", $contato->getEmail());
            $p_sql->bindValue(":codestado", $contato->get_CodEstado());
            return $p_sql->execute();
        }catch(Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function editar(Contato $contato){
        try{
            $sql = "UPDATE contato SET nome = :nome, telefone = :telefone, 
            email = :email, codigo_estado = :codestado WHERE codigo = :codigo";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":codigo", $contato->getCod_contato());
            $p_sql->bindValue(":nome", $contato->getNome());
            $p_sql->bindValue(":telefone", $contato->getTelefone());
            $p_sql->bindValue(":email", $contato->getEmail());
            $p_sql->bindValue(":codestado", $contato->get_CodEstado());
            return $p_sql->execute();
        }catch(Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function excluir(Contato $contato){
        try{
            $sql = "DELETE FROM contato WHERE codigo = :codigo";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":codigo", $contato->getCod_contato());
            return $p_sql->execute();
        }catch(Exception $e){
            print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function listar(){
        try{
            $sql = "SELECT c.*, e.nome nome_estado, e.sigla FROM contato c LEFT JOIN estado e ON (c.codigo_estado = e.codigo)";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);

            return $lista;
        }catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação,
            foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function busca_contato($id){
        try{
            $sql = "SELECT * FROM contato WHERE codigo = :id";
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