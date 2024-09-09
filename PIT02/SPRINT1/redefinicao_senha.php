<?php
session_start();

// Mensagem de status
$statusMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recoveryCode = $_POST['recovery_code'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';

    // Verificar o código de recuperação
    if ($recoveryCode == $_SESSION['recovery_code'] && !empty($newPassword)) {
        // Aqui você deve adicionar o código para atualizar a senha no banco de dados
        // Exemplo abaixo apenas simula a operação
        // Atualize a senha no banco de dados (exemplo fictício)
        
        // Mensagem de sucesso
        $statusMessage = 'Sua senha foi alterada com sucesso!';
    } else {
        $statusMessage = 'Código de recuperação inválido ou senha não fornecida.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #f39c12;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #f39c12;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #e67e22;
        }
        .status-message {
            text-align: center;
            color: #e67e22;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Redefinir Senha</h1>
        <div class="status-message">
            <?php if ($statusMessage): ?>
                <p><?php echo htmlspecialchars($statusMessage); ?></p>
            <?php endif; ?>
        </div>
        <form method="post" action="">
            <div class="form-group">
                <label for="recovery_code">Código de Recuperação:</label>
                <input type="text" id="recovery_code" name="recovery_code" placeholder="Digite o código de recuperação">
            </div>
            <div class="form-group">
                <label for="new_password">Nova Senha:</label>
                <input type="password" id="new_password" name="new_password" placeholder="Digite sua nova senha">
            </div>
            <div class="form-group">
                <button type="submit">Redefinir Senha</button>
            </div>
        </form>
    </div>

</body>
</html>
