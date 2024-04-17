<?php
require_once("dao.contato.php");

$objContato = new DaoContato();
$contato = new Contato();

if(isset($_POST['id'])){
    $id = $_POST['id'];
}else{
    $id = '';
}

$contato->setCod_contato($id);
$objContato->excluir($contato);
echo "Registro excluído com sucesso.";
// echo "<br/>";
// echo "<a href='listar.php'><button>Voltar</button></a>";

?>
