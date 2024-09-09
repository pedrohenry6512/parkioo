<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Contato - Parkio</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background: #FF6F00;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            display: flex;
            width: 80%;
            margin: auto;
            margin-top: 30px;
            overflow: hidden;
        }
        .contact-info {
            width: 45%;
            padding: 30px;
            border-radius: 10px;
            margin-right: 5%;
        }
        .contact-info h2 {
            color: #FF6F00;
            margin-bottom: 20px;
            font-size: 50px;
        }
        .contact-info p {
            font-size: 20px;
            color: #555;
            margin-bottom: 20px;
        }
        .form-container {
            width: 50%;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-container h2 {
            color: #FF6F00;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .form-container input,
        .form-container textarea {
            margin-bottom: 20px;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container input:focus,
        .form-container textarea:focus {
            border-color: #FF6F00;
            box-shadow: 0 0 8px rgba(255, 111, 0, 0.3);
            outline: none;
        }
        .form-container button {
            padding: 15px;
            background-color: #FF6F00;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .form-container button:hover {
            background-color: #e65c00;
            transform: scale(1.02);
        }
        .form-container button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

<header>
    <h1>Parkio - Estacionamento</h1>
</header>

<div class="container">
    <div class="contact-info">
        <h2>Ficou com Dúvidas?</h2>
        <p>Estamos aqui para ajudar! Com Parkio, sua vida fica muito mais fácil.</p>
    </div>

    <div class="form-container">
        <h2>Fale Conosco</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitização dos dados recebidos
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['phone']);
            $subject = htmlspecialchars($_POST['subject']);
            $message = htmlspecialchars($_POST['message']);

            // Validação dos campos obrigatórios
            if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
                // Aqui você pode adicionar o código para enviar o email ou salvar os dados
                echo "<p style='color: green;'>Formulário enviado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Por favor, preencha todos os campos obrigatórios!</p>";
            }
        }
        ?>

        <form id="contactForm" method="POST" action="">
            <label for="name">Nome Completo:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Telefone:</label>
            <input type="tel" id="phone" name="phone">

            <label for="subject">Assunto:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Mensagem:</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
</div>

</body>
</html>
