<?php

session_start();
include_once("db.php");

$id = $_GET['id'];

$deletaUsuario = $conn->prepare("DELETE FROM cadastro WHERE id=?");
$deletaUsuario->bindParam(1, $id, PDO::PARAM_INT);

$deletaUsuario->execute();

if($deletaUsuario->rowCount()){
    $_SESSION['sucesso'] = "<p style='color: blue;'>Usuário Excluido com sucesso</p>";
    header("Location: listar.php");
}else{
    $_SESSION['sucesso'] = "<p style='color: red;'>ERRO ao excluir usuário</p>";
    header("Location: listar.php");
}