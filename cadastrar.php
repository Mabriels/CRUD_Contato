<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contato</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Cadastro de Contato</h1>
    <form id="frmContato" action="gravar.php" method="POST">
        Nome: 
        <input type="text" name="nome" id="nome" required><br/>

        Telefone:
        <input type="text" name="telefone" id="telefone" required><br/>

        E-mail:
        <input type="email" name="email" id="email" required><br/>

        <?php
        require_once('dao.estado.php');

        $estado = new DaoEstado();

        echo "Estado onde mora:";
        echo "<select name='estado'>";
        foreach($estado->listar() as $valor):
            echo "<option value='{$valor['codigo']}'>{$valor['nome']} - {$valor['sigla']}</option>";
        endforeach;
        echo "</select><br/>";
        ?>

        <input type="submit" value="Gravar Dados" id="gravar">
    </form>

    <div id="msg"></div>

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
                            $('#frmContato')[0].reset();
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