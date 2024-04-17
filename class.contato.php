<?php

class Contato{

    private $cod_contato;
    private $nome;
    private $telefone;
    private $email;
    private $cod_estado;

    public function setCod_contato($cod_contato){
        $this->cod_contato = $cod_contato;
    }

    public function getCod_contato(){
        return $this->cod_contato;
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

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function set_CodEstado($valor){
        $this->cod_estado = $valor;
    }

    public function get_CodEstado(){
        return $this->cod_estado;
    }

}
?>