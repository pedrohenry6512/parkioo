<?php
session_start();

// Mensagem de status
$statusMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (!empty($email) || !empty($phone)) {
        // Aqui você deve conectar ao banco de dados e verificar se o e-mail ou telefone existe
        // Código de exemplo abaixo apenas simula a operação

        // Gerar código de recuperação e armazenar no banco de dados
        $recoveryCode = rand(100000, 999999); // Código de recuperação aleatório
        $_SESSION['recovery_code'] = $recoveryCode;

        // Enviar código de recuperação por e-mail
        if (!empty($email)) {
            // Substitua pelos seus dados reais
            $to = $email;
            $subject = "Código de Recuperação de Senha";
            $message = "Seu código de recuperação é: $recoveryCode";
            $headers = "From: no-reply@seusite.com";

            mail($to, $subject, $message, $headers);
            $statusMessage = 'Um código de recuperação foi enviado para o seu e-mail.';
        }

        // Enviar código de recuperação por SMS
        if (!empty($phone)) {
            // Código para envio de SMS (exemplo, não funcional)
            // Substitua pelo serviço de SMS que você utiliza
            // $sms_sent = send_sms($phone, "Seu código de recuperação é: $recoveryCode");
            $statusMessage = 'Um código de recuperação foi enviado para o seu telefone.';
        }
    } else {
        $statusMessage = 'Por favor, insira um e-mail ou número de telefone.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
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
        <h1>Recuperação de Senha</h1>
        <div class="status-message">
            <?php if ($statusMessage): ?>
                <p><?php echo htmlspecialchars($statusMessage); ?></p>
            <?php endif; ?>
        </div>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
                <label for="phone">Telefone:</label>
                <input type="text" id="phone" name="phone" placeholder="Digite seu telefone">
            </div>
            <div class="form-group">
                <button type="submit">Enviar Código de Recuperação</button>
            </div>
        </form>
    </div>

</body>
</html>
