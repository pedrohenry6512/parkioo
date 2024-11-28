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

// Configuração do banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuário do MySQL
$password = ""; // Substitua pela sua senha do MySQL
$dbname = "comentarios";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Adiciona um comentário se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['comentario']) && !empty($_POST['nome'])) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $sql = "INSERT INTO comentario (nome, comentario) VALUES ('$nome', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a mesma página para evitar reenvio do formulário
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p class='error'>Erro: " . $conn->error . "</p>";
    }
}

// Deleta um comentário se o ID for fornecido
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM comentario WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a mesma página após a exclusão
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p class='error'>Erro: " . $conn->error . "</p>";
    }
}

// Recupera todos os comentários
$sql = "SELECT * FROM comentario";
$result = $conn->query($sql);

// Filtrando as vagas com base na busca
$filteredJobs = [];
if ($searchValue) {
    foreach ($jobs as $job) {
        if (strpos(strtolower($job['title']), $searchValue) !== false || strpos(strtolower($job['location']), $searchValue) !== false) {
            $filteredJobs[] = $job;
        }
    }
} else {
    $filteredJobs = $jobs;
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
            height: 100px;
        }

        h1{
            margin-left: 60px;

        }

        header div img {
            height: 150px;
            /* Altura menor para reduzir o tamanho da imagem */
            width: auto;
            /* Mantém a proporção da imagem */
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
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
            margin-bottom: 40px;
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
            justify-content: space-between;
            position: relative;
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

        .job-details h3 {
            margin: 0;
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
            margin: 10px;
        }

        .buy-button:hover {
            background-color: #e65b00;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            gap: 5px;
        }

        .search-input {
            padding: 8px;
            font-size: 14px;
            width: 220px;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        .search-button {
            padding: 8px 15px;
            font-size: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        .footer {
    background-color: rgba(255, 255, 255, 0.9);
    /* Fundo branco transparente */
    color: #333;
    /* Cor do texto */
    padding: 20px;
    /* Espaçamento interno */
    text-align: center;
    /* Centraliza o texto */
    font-family: 'Arial', sans-serif;
    /* Fonte do texto */
    font-size: 14px;
    /* Tamanho da fonte */
    border-top: 1px solid #ccc;
    /* Borda superior cinza clara */
    width: 100%;
    /* Garante que o rodapé ocupe toda a largura */
    box-sizing: border-box;
    /* Garante que o padding e a borda sejam incluídos na largura total */
    position: relative;
    /* Garante que o rodapé seja relativo aos outros elementos */
}

.footer p {
    margin-top: 40px; /* Move o parágrafo mais para baixo */
    margin-bottom: 0; /* Remove qualquer margem inferior, se necessário */
}

.footer img {
    margin-top: 20px; /* Espaço acima da imagem */
    display: block;   /* Faz com que a imagem seja um bloco */
    margin-left: auto; /* Centraliza horizontalmente */
    margin-right:0%; /* Centraliza horizontalmente */
}



    </style>
</head>

<body>
    <header>
        <div>
            <img src="../assets/logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="./cupons.php">Cupons</a></li>
                <li><a href="../SPRINT1/index.php">Página inicial</a></li>
                <li><a href="./minha.conta.html">Minha Conta</a></li>
                <li><a href="./contato.php">Contato</a></li>
            </ul>
        </nav>
    </header>

    <div class="search-container">
        <form action="" method="get">
            <input type="text" name="search" class="search-input" placeholder="Busca por vagas disponíveis..." value="<?php echo htmlspecialchars($searchValue); ?>">
            <button type="submit" class="search-button">Buscar</button>
        </form>
    </div>

    <h1>           Vagas Disponíveis</h1>

    <div class="content">
        <div class="jobs-wrap">
            <?php
            if (count($filteredJobs) > 0) {
                foreach ($jobs as $job) {
                    if (strpos(strtolower($job['title']), $searchValue) !== false) {
                        echo '
                        <div class="job-item">
                        <div class="company-logo">
                       
                    </div>
                            <div class="job-details">
                                <h3>' . htmlspecialchars($job['title']) . '</h3>
                                <p>' . htmlspecialchars($job['location']) . '</p>
                            </div>
                            <button class="buy-button" onclick="window.location.href=\'formulario_pagamento.php\';">Comprar</button>
                            <button class="buy-button" onclick="window.location.href=\'reserva_vaga.php\';">Reservar</button>
                        </div>';
                        $hasResults = true;
                    }
                }
            } else {

                echo "<p class='no-jobs-message'>Nenhuma vaga encontrada para sua busca.</p>";
            }
            ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Empresa. Todos os direitos reservados.</p>
    </footer>
</body>

</html>