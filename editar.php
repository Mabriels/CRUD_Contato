<?php

require_once("dao.contato.php");

$objContato = new DaoContato();

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = '';
}

$dados = $objContato->busca_contato($id);

// print_r($dados);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Contato</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Edição de Contato</h1>
    <form id="frmContato" action="gravar_editar.php" method="POST">
        <input type="hidden" name="codigo" id="codigo" value='<?php echo $dados['codigo']; ?>'>
        Nome: 
        <input type="text" name="nome" id="nome" value='<?php echo $dados['nome']; ?>' required><br/>

        Telefone:
        <input type="text" name="telefone" id="telefone" value='<?php echo $dados['telefone']; ?>' required><br/>

        E-mail:
        <input type="email" name="email" id="email" value='<?php echo $dados['email']; ?>' required><br/>

        <?php
        require_once('dao.estado.php');

        $estado = new DaoEstado();

        echo "Estado onde mora:";
        echo "<select name='estado'>";
            echo "<option></option>";
        foreach($estado->listar() as $valor):
            echo "<option value='{$valor['codigo']}' ";
            if ($dados['codigo_estado'] == $valor['codigo']) 
                echo 'selected=selected ';
            echo ">{$valor['nome']} - {$valor['sigla']}</option>";
        endforeach;
        echo "</select><br/>";
        ?>

        <input type="submit" value="Salvar Dados" id="gravar">
    </form>

    <a href='listar.php'><button>Voltar</button></a>
    <div id="msg"></div>

    <div id="referencias">
        <h2>Referências Pessoais</h2>
        <table border=1>
            <tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td></td>
                <td></td>
            </tr>

            <?php
            require_once("dao.referencia.php");

            $ref = new DaoReferencia();

            foreach($ref->listar_referencia_contato($_GET['id']) as $referencia):
            ?>
            <tr>
                <td><?php echo $referencia['codigo']; ?></td>
                <td><?php echo $referencia['nome']; ?></td>
                <td><?php echo $referencia['telefone']; ?></td>
                <td><a href='editar_ref.php?id=<?php echo $referencia['codigo']; ?> '>Editar</a></td>
                <td><a href='#'>Excluir</a></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table>
        <a href='cadastrar_ref.php?contato=<?php echo $dados['codigo']; ?>'><button>Cadastrar Referência</button></a>
    </div>
    

    <script>
        $(function(){
            $("#gravar").click(function(){
                $("#frmContato").submit(function(e)
                {    
                    var postData = $(this).serializeArray();
                    var formURL = $(this).attr("action");
                    $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data, textStatus, jqXHR) 
                        {
                            $("#msg").html(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                            
                            var error = textStatus + '<br/>' +errorThrown;
                            $("#msg").html(error);
                        }
                    });
                    e.preventDefault();	//STOP default action
                    e.unbind();
                });
            });
        });
    </script>    
</body>
</html>