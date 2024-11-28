<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Parkio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFA500;
            color: white;
            background-image: url('../assets/Home01.png');
            background-repeat: no-repeat;
        }
        form {
            max-width: 400px;
            min-height: 707px;
            margin: 50px auto;
            padding: 48px 68px;
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            position: relative;
            background-color: #FFA500;
            z-index: 1001;
        }
        form h2 {
            color: white;
        }
        form label {
            display: block;
            margin-bottom: 10px;
            color: white;
            font-size: 16px;
            text-align: left;
        }
        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #FFA500;
            border-radius: 5px;
            font-size: 16px;
            color: rgb(0, 0, 0);
            opacity: 0.7;
        }
        form button {
            background-color: #383bec;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }
        form button#voltarBtn {
            background-color: #383bec;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        form button:hover {
            background-color: #FFFFFF;
            color: #FFA500;
        }
        .mensagem {
            display: none;
            margin-top: 20px;
            color: white;
            font-size: 18px;
            justify-content: center;
            left: 100px;
        }
    </style>
</head>
<body>
    <form id="cadastroForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h2>Cadastro</h2>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <button type="submit" id="cadastrarBtn">Cadastrar</button>
        <button type="button" id="voltarBtn" onclick="window.history.back()">Voltar</button>
        <div class="mensagem" id="mensagemCadastro">
            <?php 
                if (isset($mensagemSucesso)) {
                    echo $mensagemSucesso;
                }
            ?>
        </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Conexão com o banco de dados (exemplo de conexão MySQL)
        // $conn = new mysqli('localhost', 'root', '', 'parkio');

        // // Verifica a conexão
        // if ($conn->connect_error) {
        //     die("Falha na conexão: " . $conn->connect_error);
        // }

        // // Prepara e executa a consulta para inserção de dados
        // $sql = "INSERT INTO usuarios VALUES (?, ?, ?, ?)";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param('default', $nome, $email, password_hash($senha, PASSWORD_DEFAULT));

        // if ($stmt->execute()) {
        //     $mensagemSucesso = "Usuário cadastrado com sucesso!";
        //     echo "<script>
        //             document.getElementById('mensagemCadastro').style.display = 'block';
        //             setTimeout(function() {
        //                 window.location.href = 'cadastro.php';
        //             }, 3000);
        //           </script>";
        // } else {
        //     echo "<script>alert('Erro ao cadastrar usuário');</script>";
        // }

        // // Fecha a conexão
        // $stmt->close();
        // $conn->close();


        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'parkio';

        if ($nome == '' or $email == '' or $senha == '')
        {
            echo"<script language='javascript' type='text/javascript'>alert('Você não preencheu todos os campos! Tente novamente!');;</script>";
        }
        else
        {
            $conn = mysqli_connect($host,$user,$pass,$dbname);

            $sql = "INSERT INTO usuarios values('default','$nome','$email', '" . password_hash($senha, PASSWORD_DEFAULT) ."')";
            mysqli_query($conn,$sql);

            echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='login.php';</script>";
        }
    }
    ?>
</body>
</html>
