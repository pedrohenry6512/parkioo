<?php
// Simulando dados de vagas para exemplo
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

// Verificar se o formulário foi enviado
$searchValue = '';
if (isset($_GET['search'])) {
    $searchValue = strtolower(trim($_GET['search']));
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Busca</title>
    
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #FF6F00;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .jobs-wrap {
            width: 100%;
            max-width: 800px;
        }
        .job-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #dddddd;
            background: #ffffff;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .company-logo img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #FF6F00;
        }
        .job-details {
            flex: 1;
            margin-left: 15px;
        }
        .no-jobs-message {
            margin-top: 20px;
            color: red;
            font-weight: bold;
            text-align: center;
        }
        .buy-button {
            background-color: #FF6F00;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .buy-button:hover {
            background-color: #e65b00;
        }
    </style>
</head>
<body>
    <header>
        <img src="./logo.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="./index.html">Página inicial</a></li>
                <li><a href="./">Sobre</a></li>
                <li><a href="./contato.php">Contato</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <h1>Resultados da Busca</h1>

        <div class="jobs-wrap">
            <?php
            $hasResults = false;
            foreach ($jobs as $job) {
                $jobTitle = strtolower($job['title']);
                $jobLocation = strtolower($job['location']);
                if (strpos($jobTitle, $searchValue) !== false || strpos($jobLocation, $searchValue) !== false) {
                    echo'
                    <div class="job-item">
                        <div class="company-logo">
                            <img src="./localizaçao" alt="Logo">
                        </div>
                        <div class="job-details">
                            <h3>' . htmlspecialchars($job['title']) . '</h3>
                            <p>' . htmlspecialchars($job['location']) . '</p>
                        </div>
                        <button class="buy-button">Comprar</button>
                    </div>
                    ';
                    $hasResults = true;
                }
            }

            if (!$hasResults) {
                echo '<p class="no-jobs-message">Nenhuma vaga encontrada.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
