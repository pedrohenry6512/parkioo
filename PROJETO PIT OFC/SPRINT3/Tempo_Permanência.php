<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tempo'])) {
    $tempoSelecionado = $_POST['tempo'];
    $pagina = '';

    // Determina a página para redirecionar com base no tempo selecionado
    switch ($tempoSelecionado) {
        case '30':
            $pagina = 'ProcessandoPa_30min.php'; // Página para 30 minutos
            break;
        case '300':
            $pagina = 'ProcessandoPa_5h.php'; // Página para 5 horas
            break;
        case '600':
            $pagina = 'ProcessandoPa_10h.php'; // Página para 10 horas
            break;
        case '1440':
            $pagina = 'ProcessandoPa_24h.php'; // Página para 24 horas
            break;
        default:
            // Em caso de opção inválida, redireciona para uma página de erro ou retorna para a página inicial
            $pagina = 'index.php';
    }

    // Redireciona para a página correspondente
    header("Location: $pagina");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Tempo de Permanência</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        select, button {
            width: calc(100% - 22px);
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        select {
            background-color: #fafafa;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selecionar Tempo de Permanência</h2>
        <form method="POST" action="">
            <label for="tempo">Escolha o tempo de permanência:</label>
            <select id="tempo" name="tempo" required>
                <option value="30">30 minutos - 10 reais</option>
                <option value="300">5 horas - 20 reais</option>
                <option value="600">10 horas - 48 reais</option>
                <option value="1440">24 horas - 50 reais</option>
            </select>

            <button type="submit">Confirmar</button>
        </form>
    </div>
</body>
</html>
