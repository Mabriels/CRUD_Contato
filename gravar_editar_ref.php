<?php

require_once("dao.referencia.php");

$id_referencia = $_POST['id_referencia'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

$ref = new Referencia();
$ref->setCodigo($id_referencia);
$ref->setNome($nome);
$ref->setTelefone($telefone);

$db = new DaoReferencia();
if($db->editar($ref))
    echo "Referência editada com sucesso!";
?>