<?php

require_once("dao.referencia.php");

$id_contato = $_POST['id_contato'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

$ref = new Referencia();
$ref->setIdContato($id_contato);
$ref->setNome($nome);
$ref->setTelefone($telefone);

$db = new DaoReferencia();
if($db->inserir($ref))
    echo "Referência inserida com sucesso!";
?>