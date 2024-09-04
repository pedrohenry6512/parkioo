<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Consultar o usuário pelo nome
    $sql = 'SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'senha' => $senha]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Senha correta
        $_SESSION['usuario_id'] = $usuario['id'];
        header('Location: dados.html');
        exit();
    } else {
        // Senha incorreta
        echo "Nome ou senha inválidos!";
    }
} else {
    echo "Método de requisição inválido!";
}
?>
