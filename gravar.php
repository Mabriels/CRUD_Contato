<?php

require_once("dao.contato.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$estado = $_POST['estado'];

$contato = new Contato();
$contato->setNome($nome);
$contato->setTelefone($telefone);
$contato->setEmail($email);
$contato->set_CodEstado($estado);

$db = new DaoContato();
if($db->inserir($contato))
    echo "Contato inserido com sucesso";
?>