<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Referência de Contato</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Cadastro de Referência de Contato</h1>
    <form id="frmContato" action="gravar_ref.php" method="POST">
        <input type="hidden" name="id_contato" value="<?php echo $_GET['contato']; ?>">
        Nome: 
        <input type="text" name="nome" id="nome" required><br/>

        Telefone:
        <input type="text" name="telefone" id="telefone" required><br/>

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