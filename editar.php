<?php
    session_start();
    include_once("db.php");

    $id_user = $_GET['id'];

    $usuario = $conn->prepare("SELECT nome, email FROM cadastro WHERE id=?");
    $usuario->bindParam(1, $id_user, PDO::PARAM_INT);
    $usuario->execute();

    $linhaUSER = $usuario->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PDO - INSERT</title>
</head>
<body>
    <h1>CRUD com PDO - Editar Usuário e Email</h1>

    <hr>

    <form action="" name="formulario" method="post">
        <label for="">Nome</label>
        <input type="text" name="nome" value="<?php echo $linhaUSER['nome'] ?>">
        <br><br>

        <label for="">Email</label>
        <input type="text" name="email" value="<?php echo $linhaUSER['email'] ?>">
        <br><br>
        <input type="hidden" name="id" value="<?php echo $id_user ?>">
        <input type="submit" name="botao" value="Cadastrar">
    </form>


    <?php
        // Recebendo dados do formulário
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Verificando se usuario apertou no botão
        if(!empty($formulario['botao'])){

            // Verificando se formulário foi preenchido nome e email
            if(!empty($formulario['nome'] and !empty($formulario['email']))){

                // Verificando se email é válido
                if(filter_var($formulario['email'], FILTER_VALIDATE_EMAIL)){
                    
                    // Removendo espaços em branco do inicio e fim
                    $formulario = array_map('trim', $formulario);

                    // Atribuindo POSTs para variáveis
                    $id = $formulario['id'];
                    $nome = $formulario['nome'];
                    $email = $formulario['email'];

                    //echo "id ".$id." nome ".$nome." email ".$email;

                    // UPDATE usando $conn->prepare
                    $updateUsuario = $conn->prepare("UPDATE cadastro SET nome=?, email=? WHERE id=?");

                    // Preenchendo cada campo indicado pelo (?) acima.
                    $updateUsuario->bindParam(1, $nome, PDO::PARAM_STR);
                    $updateUsuario->bindParam(2, $email, PDO::PARAM_STR);
                    $updateUsuario->bindParam(3, $id, PDO::PARAM_INT);
                    
                    // Executando comando.
                    $updateUsuario->execute();

                    if($updateUsuario->rowCount()){
                        $_SESSION['sucesso'] = "<p style='color: blue;'>Usuário Atualizado com sucesso</p>";
                        header("Location: listar.php");
                        
                    }else{
                        echo "<p style='color: red;'>ERRO ao cadastrar usuário.</p>";
                        
                    }

                }else{
                    echo "<p style='color: red;'>ERRO! Email inválido!.</p>";
                }

                
            }else{
                echo "<p style='color: red;'>Você apertou o botão mas não preencheu a porra do formulário.</p><br><br>";
            }
            
        }
    ?>

    <a href="listar.php">Listar Usuários</a><br>


    
</body>
</html>