<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
</head>
<body>
    <h1>Lista de Contatos</h1>
    <script>
        function excluir(id){
            resp = confirm("Você realmente deseja excluir esse registro?");
            if(resp){
                // window.location.assign('excluir.php?id=' + id);
                $.post("excluir.php", {id:id}, function(result){
                    alert(result);
                    location.reload();
                });
            }
        }
    </script>
    <?php
        require_once("dao.contato.php");
        $db = new DaoContato();
        $contatos = $db->listar();

        echo "<table id='contatos' class='display'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Código</th>";
        echo "<th>Nome</th>";
        echo "<th>Telefone</th>";
        echo "<th>E-mail</th>";
        echo "<th>Estado</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($contatos as $linha) {
            echo "<tr>";
            echo "<td>{$linha['codigo']}</td>";
            echo "<td>{$linha['nome']}</td>";
            echo "<td>{$linha['telefone']}</td>";
            echo "<td>{$linha['email']}</td>";
            echo "<td>{$linha['nome_estado']} - {$linha['sigla']}</td>";
            echo "<td><a href='editar.php?id={$linha['codigo']}'>Editar</a></td>";
            echo "<td><a href='javascript:excluir({$linha['codigo']});'>Excluir</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    ?>

<!-- Responsive DataTables-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#contatos').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
                },
                dom: 'Bfrtip',
                buttons: [ 'copy','csv', 'excel', 'pdf', 'print' ],
                responsive: true,
            });
        } );
    </script>
</body>
</html>
