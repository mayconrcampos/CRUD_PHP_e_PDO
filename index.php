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
        <input type="text" name="email">
        <br><br>

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
                    $nome = $formulario['nome'];
                    $email = $formulario['email'];

                    // Verificando se nome OU email já existem no DB.
                    $existe = $conn->prepare("SELECT nome, email FROM cadastro WHERE nome=? OR email=?");
                    $existe->execute(array($nome, $email));
                    $linha = $existe->fetchAll();

                    if(empty($linha)){
                        // Insert usando $conn->prepare
                        $insereUsuario = $conn->prepare("INSERT INTO cadastro (nome, email) VALUES (?, ?)");

                        // Preenchendo cada campo indicado pelo (?) acima.
                        $insereUsuario->bindParam(1, $nome, PDO::PARAM_STR);
                        $insereUsuario->bindParam(2, $email, PDO::PARAM_STR);

                        // Executando comando.
                        $insereUsuario->execute();

                        if($insereUsuario->rowCount()){
                            echo "<p style='color: blue;'>Usuário Cadastrado com sucesso</p>";
                            


                        }else{
                            echo "<p style='color: red;'>ERRO ao cadastrar usuário.</p>";
                        }

                    }else{
                        echo "<p style='color: red;'>ERRO! Usuário já está cadastrado..</p>";
                    }

                    

                }else{
                    echo "<p style='color: red;'>ERRO! Email inválido!.</p>";
                }

                
            }else{
                echo "<p style='color: red;'>Você apertou o botão mas não preencheu a porra do formulário.</p><br><br>";
            }
            
        }
    ?>

    <a href="./listarusuarios.php">Listar Usuários</a><br>


    
</body>
</html>