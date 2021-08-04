<?php
    session_start();
    include_once("db.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PDO - READ (SELECT)</title>
</head>
<body>
    <h1>Listando usuários cadastrados</h1>

    <table border="1px">
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php 

            // Criar paginação
            $pagina = $_GET['pagina'];
            echo "pagina".$pagina;

            $listaUsuarios = $conn->prepare("SELECT id, nome, email FROM cadastro");
            $listaUsuarios->execute();

            while($linha = $listaUsuarios->fetch(PDO::FETCH_ASSOC)){  ?>
                <tr>
                    <td><?php echo $linha['id'] ?></td>
                    <td><?php echo $linha['nome'] ?></td>
                    <td><?php echo $linha['email'] ?></td>
                    <td><a href="editar.php?id=<?php echo $linha['id'] ?>">Editar</a></td>
                    <td><a href="delete.php?id=<?php echo $linha['id'] ?>"  onclick="return confirm('Você realmente deseja excluir este registro?    ')">Excluir</a></td>
                </tr>

<?php     } ?>
    </table>

    <?php 
        if(isset($_SESSION['sucesso'])){
            echo $_SESSION['sucesso'];
            unset($_SESSION['sucesso']);
        }
    ?>

    <br>
    <a href="index.php">Cadastrar</a>
</body>
</html>