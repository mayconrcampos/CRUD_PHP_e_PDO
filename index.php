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
    <title>CRUD - PDO</title>
</head>
<body>
    <h1>CRUD com PDO - Cadastrar Usuário e Email</h1>

    <hr>

    <form action="" name="formulario" method="post">
        <label for="">Nome</label>
        <input type="text" name="nome">
        <br><br>

        <label for="">Email</label>
        <input type="email" name="email">
        <br><br>

        <input type="submit" name="botao" value="Cadastrar">
    </form>


    <?php
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($formulario['botao'])){
            if(!empty($formulario['nome'] and !empty($formulario['email']))){
                $nome = $formulario['nome'];
                $email = $formulario['email'];

                $insereUsuario = $conn->prepare("INSERT INTO cadastro (nome, email) VALUES ('$nome', '$email')");
                $insereUsuario->execute();

                if($insereUsuario->rowCount()){
                    echo "<br>Usuário Cadastrado com sucesso<br>";
                }else{
                    echo "<br>ERRO ao cadastrar usuário.<br>";
                }


            }else{
                echo "Você apertou o botão mas não preencheu a porra do formulário.<br><br>";
            }
            
        }
    ?>

    <a href="./listarusuarios.php">Listar Usuários</a><br>


    
</body>
</html>