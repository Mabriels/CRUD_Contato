<?php

class Referencia{

    private $codigo;
    private $nome;
    private $telefone;
    private $id_contato;

    public function setIdContato($valor){
        $this->id_contato = $valor;
    }

    public function getIdContato(){
        return $this->id_contato;
    }

    public function setCodigo($valor){
        $this->codigo = $valor;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getTelefone(){
        return $this->telefone;
    }
}
?>