<?php
// Definições de variáveis
$logoPath = 'logo.png';
$qrcodePath = '20.png';
$pixCode = '00020101021126450014br.gov.bcb.pix0123pedro12042006@gmail.com52040000530398654045.005802BR5918PEDRO H V DE PAULA6013RIBEIRAO DAS 62070503***630401CC';
$pixKey = 'api.pagseguro.com/pix/v2/0E42A47B-D782-473A-8A8E-261C0992412D';
$amount = 'R$ 20,00';
$location = 'Brasil';
$receiver = 'PAGSEGURO TECNOLOGIA';
$identifier = 'Parkio';
$timerDuration = 30; // Tempo inicial em segundos
// Gerar o QR Code


echo "<div>";

echo "</div>";
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Vaga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: url('Home2.png') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            width: 100%;
            max-width: 400px;
            min-height: 400px; /* Altura mínima aumentada */
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            color: #003366; /* Azul escuro */
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #003366;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #003366;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #FF8C00; /* Laranja */
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #e67e00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reserva de Vaga para Estacionamento</h2>
        <form action="processa_reserva.php" method="POST">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>

            <label for="duracao">Duração da Reserva:</label>
            <select id="duracao" name="duracao" required>
                <option value="10">10h - 20 R$</option>
                <option value="20"> 5h- 10R$</option>
                <option value="30">24h - 50R$</option>
                <option value="50">30m - 5R$</option>
            </select>

            <button type="submit">Prosseguir</button>
        </form>
    </div>
</body>
</html>