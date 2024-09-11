<?php
// Iniciar sessão
session_start();

// Simular dados do usuário (normalmente você obteria isso de um banco de dados)
$user = [
    'name' => 'Pedro',
    'email' => 'pedro@a',
    'password' => '1234' // Senha criptografada deve ser usada no banco de dados
];

// Verificar se o formulário foi enviado para atualizar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Atualizar os dados
    $user['name'] = $_POST['name'];
    $user['email'] = $_POST['email'];
    // Aqui você deve adicionar lógica para atualizar a senha, geralmente criptografando-a
    $user['password'] = $_POST['password'];
    
    // Simular a atualização no banco de dados
    echo "Dados atualizados com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Perfil do Usuário</h1>
        
        <form method="POST" action="">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
            
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br>
            
            <input type="submit" value="Atualizar Dados">
        </form>
    </div>
</body>
</html>
