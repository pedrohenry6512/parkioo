<?php
$host = 'localhost'; // ou o IP do seu servidor MySQL
$dbname = 'test';
$username = 'root'; // substitua pelo seu nome de usuário do MySQL
$password = ''; // substitua pela sua senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Não foi possível conectar ao banco de dados: " . $e->getMessage());
}
?>
