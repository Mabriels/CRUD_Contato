<?php

require_once("dao.contato.php");

$codigo = $_POST['codigo'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$estado = $_POST['estado'];

$contato = new Contato();
$contato->setCod_contato($codigo);
$contato->setNome($nome);
$contato->setTelefone($telefone);
$contato->setEmail($email);
$contato->set_CodEstado($estado);

$db = new DaoContato();
if($db->editar($contato))
    echo "Contato alterado com sucesso";
?>