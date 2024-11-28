<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Parkio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFA500;
            /* Laranja */
            color: white;
            /* Branco */
            text-align: center;
            background-image: url('../assets/Home.png');
            background-repeat: no-repeat;
        }

        @media only screen and (max-width: 600px) {
            body {
                background-image: none;
                /* Esconde a imagem em telas menores que 600px */
            }
        }

        form {
            max-width: 300px;
            min-height: 707px;
            margin: 50px auto;
            padding: 50px;
            background-color: #FFA500;
            /* Laranja */
            border-radius: 10px;
            border: 2px solid #FFA500;
            /* Borda laranja */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* Preto com transparência */
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            text-align: left;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #fcfbfb;
            /* Branco */
            border-radius: 5px;
            font-size: 16px;
        }

        .form-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .form-buttons button {
            background-color: #383bec;
            /* Azul */
            color: #FFFFFF;
            /* Branco */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            margin: 0;
            /* Remove margens extras */
        }

        .form-buttons button:hover {
            background-color: #FFA500;
            /* Laranja ao passar o mouse */
        }

        .form-buttons button+button {
            margin-left: 10px;
            /* Espaço entre os botões */
        }
    </style>
</head>

<body>
<form id="loginForm" method="post">
    <div class="tituloForm">Login</div>
    <p style="color: red;"></p>
    <label for="email">E-mail:</label><br>
    <input type="email" name="email" id="email" required>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
    <div class="formInput">
        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha" required>
    </div>
    <div class="form-buttons">
        <button type="submit" name="login">Entrar</button>
        <button type="button" onclick="window.location.href='index.php'">Voltar</button>
    </div>
</form>
</body>
</html>

<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

// Verifica se o formulário foi enviado
if (isset($_POST['login'])) {

    // Obtém os dados do formulário
    $login = $_POST['email'];
    $senha = $_POST['senha'];

    // Conectar ao banco de dados com mysqli
    $connect = new mysqli('localhost', 'root', '', 'parkio');

    // Verifica a conexão com o banco de dados
    if ($connect->connect_error) {
        die("Falha na conexão: " . $connect->connect_error);
    }

    // Prepara a consulta para evitar SQL Injection
    $stmt = $connect->prepare("SELECT senha, nome FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();
    
    // Verifica se o e-mail existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $nome);
        $stmt->fetch();
        
        // Verifica a senha com password_verify
        if (password_verify($senha, $hashed_password)) {
            // Senha correta, define as variáveis de sessão e redireciona
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $login;
            header("Location: dados.php");
            exit();
        } else {
            // Senha incorreta
            echo "<script language='javascript' type='text/javascript'>
            alert('Senha incorreta');</script>";
        }
    } else {
        // E-mail não encontrado
        echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');</script>";
    }

    // Fecha a consulta e a conexão
    $stmt->close();
    $connect->close();
}
?>
