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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code de Pagamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.856), rgb(255, 255, 255)), 
                url('Home2.png');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 100%;
            width: 100%;
            max-width: 400px;
        }

        .container img {
            width: 120px;
            margin-bottom: 10px;
        }

        .container h2 {
            margin-bottom: 10px;
        }

        #qrcode {
            margin: 10px auto;
            padding: 20px;
            background-color: #f8f8f8;
            border: 2px solid #007bff;
            border-radius: 8px;
            display: inline-block;
        }

        #qrcode img {
            width: 250px;
            height: 250px;
        }

        .payment-details {
            text-align: left;
            margin-top: 10px;
        }

        .payment-details p {
            margin: 5px 0;
        }

        .copy-code {
            margin-top: 10px;
            background-color: #e7e7e7;
            padding: 10px;
            border-radius: 8px;
            font-family: monospace;
            text-align: left;
        }

        .copy-code p {
            margin: 0;
            font-size: 14px;
            word-break: break-all;
        }

        .copy-code button {
            margin-top: 10px;
            padding: 10px;
            background-color: #285ba7;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .copy-code button:hover {
            background-color: #f0b800;
        }

        .timer {
            font-size: 20px;
            margin-top: 20px;
            font-weight: bold;
        }

        .expired-message {
            display: none;
            font-size: 20px;
            color: red;
            margin-top: 20px;
        }

        .expired-message button {
            padding: 10px;
            background-color: #285ba7;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .expired-message button:hover {
            background-color: #f0b800;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo $logoPath; ?>" alt="Logo da Empresa">
    
        <h2 id="header-text">Pague com Pix</h2>
        <div id="qrcode">
            <img src="<?php echo $qrcodePath; ?>" alt="QR Code">
        </div>
        <div class="payment-details">
            <p><strong>Destino:</strong> BoaCompra tecnologia LTDA</p>
            <p><strong>CNPJ:</strong> 06.375.668/0003-61</p>
            <div class="copy-code">
                <p id="pix-code"><?php echo $pixCode; ?></p>
                <button onclick="copyPixCode()">Copiar Código Pix</button>
            </div>
            <p><strong>Chave Pix:</strong> <?php echo $pixKey; ?></p>
            <p><strong>Valor:</strong> <?php echo $amount; ?></p>
            <p><strong>Local:</strong> <?php echo $location; ?></p>
            <p><strong>Recebedor:</strong> <?php echo $receiver; ?></p>
            <p><strong>Identificador:</strong> <?php echo $identifier; ?></p>
        </div>
        
        <div class="timer" id="timer">Tempo restante: <?php echo $timerDuration; ?>s</div>
        <div class="expired-message" id="expiredMessage">
            Tempo encerrado. <a href="dados.php"><button>Voltar</button></a>
        </div>
    </div>

    <script>
        let timeLeft = <?php echo $timerDuration; ?>;

        function updateTimer() {
            const timerElement = document.getElementById("timer");
            const expiredMessageElement = document.getElementById("expiredMessage");
            const qrcodeElement = document.getElementById("qrcode");
            const copyCodeElement = document.querySelector(".copy-code");
            const headerTextElement = document.getElementById("header-text");

            if (timeLeft <= 0) {
                timerElement.style.display = "none";
                expiredMessageElement.style.display = "block";
                qrcodeElement.classList.add("hidden");
                copyCodeElement.classList.add("hidden");
                headerTextElement.textContent = "Tempo encerrado";
            } else {
                timerElement.textContent = `Tempo restante: ${timeLeft}s`;
                timeLeft--;
                setTimeout(updateTimer, 1000);
            }
        }

        function copyPixCode() {
            const pixCodeElement = document.getElementById("pix-code");
            const range = document.createRange();
            range.selectNode(pixCodeElement);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            alert("Código Pix copiado para a área de transferência!");
        }

        updateTimer(); // Start the timer
    </script>
</body>
</html>
