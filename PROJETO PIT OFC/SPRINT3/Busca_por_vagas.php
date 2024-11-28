<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca por Vagas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-bottom: 20px;
        }
        .search-input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
            width: 250px;
        }
        .search-button {
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }
        .job-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            width: 300px;
            border-radius: 4px;
        }
        .job-item h3, .job-item p {
            margin: 0;
        }
        .buy-button {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        h1,
        h2 {
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Busca por Vagas Disponíveis</h1>

    <!-- Formulário de busca -->
    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search" class="search-input" placeholder="Digite o nome da vaga...">
            <button type="submit" class="search-button">Buscar</button>
        </form>
    </div>

    <?php
    // Lista de vagas disponíveis
    $jobs = [
        [
            'title' => 'Cotemig',
            'location' => 'Floresta, Belo Horizonte'
        ],
        [
            'title' => 'Cotemig',
            'location' => 'Barroca, Belo Horizonte'
        ],
        [
            'title' => 'Cotemig',
            'location' => 'Santa Efigênia, Belo Horizonte'
        ]
    ];

    $hasResults = false;

    // Verifica se o usuário fez uma pesquisa
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $searchValue = strtolower(trim($_POST['search'])); // Converte para minúsculas para busca insensível a maiúsculas

        // Exibe as vagas correspondentes à pesquisa
        foreach ($jobs as $job) {
            if (strpos(strtolower($job['title']), $searchValue) !== false) {
                echo '
                <div class="job-item">
                    <div class="job-details">
                        <h3>' . htmlspecialchars($job['title']) . '</h3>
                        <p>' . htmlspecialchars($job['location']) . '</p>
                    </div>
                    <button class="buy-button" onclick="window.location.href=\'formulario_pagamento.php\';">Reservar</button>
                </div>';
                $hasResults = true;
            }
        }

        // Se nenhuma vaga for encontrada
        if (!$hasResults) {
            echo '<p>Nenhuma vaga disponível para "' . htmlspecialchars($searchValue) . '".</p>';
        }
    }
    ?>
</body>
</html>
