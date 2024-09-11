<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'parkio';
$user = 'root';
$password = '';

// Cria a conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'];
    $email = $_POST['email']; // Certifique-se de que o campo no formulário seja 'email'

    // Prepara a consulta SQL para verificar se o usuário existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome = ? AND email = ?");
    $stmt->bind_param("ss", $nome, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se foi encontrado um usuário
    if ($result->num_rows > 0) {
        // Usuário encontrado, login válido, redireciona para a página de processamento
        header("Location:Tempo_Permanência.php");
        exit(); // Interrompa a execução do script após o redirecionamento
    } else {
        // Usuário não encontrado
        echo "<script>alert('Nome ou email inválido!');</script>";
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preencher Dados</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('Home.png');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 90%;
            width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .container img {
            width: 120px;
            margin-bottom: 20px;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .form-group button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .form-group button:active {
            background-color: #004494;
            transform: translateY(0);
        }

        @media (max-width: 500px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            .container img {
                width: 100px;
            }
        }
    </style>
</head>
<body>
<div class="container">
        <img src="logo.png" alt="Logo da Empresa">
        <h2>Preencher Dados</h2>
        <form id="pixForm" method="POST" action="">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="">
            </div>
            <div class="form-group">
                <label for="plate">Placa do Veículo:</label>
                <input type="text" id="plate" name="plate" required maxlength="8" placeholder="" oninput="formatPlate(this)">
            </div>
            <div class="form-group">
                <button type="submit">Prosseguir para Pagamento</button>
            </div>
        </form>
    </div>

    <script>
        function openQRCodePage() {
            const name = document.getElementById('name').value;
            const cpf = document.getElementById('email').value;
            const plate = document.getElementById('plate').value;

            if (name && cpf && plate) {
                const paymentData = `Nome: ${name}, CPF: ${cpf}, Placa: ${plate}, Valor: R$ 5,00`;
                const queryString = `?data=${encodeURIComponent(paymentData)}`;
                window.open('qrcode.html' + queryString, '_blank');
            } else {
                alert("Por favor, preencha todos os campos.");
            }
        }

        function formatCPF(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d{3})/, '$1.$2');
                value = value.replace(/(\d{3})(\d{2})/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1})$/, '$1-$2');
            }
            input.value = value;
        }

        function formatPlate(input) {
            let value = input.value.toUpperCase().replace(/\W/g, '');
            if (value.length > 7) {
                value = value.slice(0, 7);
            }
            if (value.length > 4) {
                value = value.replace(/(\w{3})(\w{1})(\w{0,4})/, '$1-$2$3');
            } else {
                value = value.replace(/(\w{3})(\w{0,1})/, '$1$2');
            }
            input.value = value;
        }
    </script>



</body>
</html>
