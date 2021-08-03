<?php

// Conexão utilizando PDO.

$host = "localhost";
$user = "root";
$senha = "5DaJ10.,Xw,8";
$DBnome = "usuarios";
$port = 3306;

// Conexão setando a porta
$conn = new PDO("mysql:host=$host;port=$port;dbname=".$DBnome, $user, $senha);
$conn->exec("SET CHARACTER SET utf8");

// Conexão sem setar a porta
//$conn = new PDO("mysql:host=$host;dbname=".$DBnome, $user, $senha);




