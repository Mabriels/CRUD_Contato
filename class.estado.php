<?php

class Estado{

    private $codigo;
    private $nome;
    private $sigla;

    public function setCodigo($valor){
        $this->codigo = $valor;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setNome($valor){
        $this->nome = $valor;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setSigla($valor){
        $this->sigla = $valor;
    }

    public function getSigla(){
        return $this->sigla;
    }

}

?>