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
        }

        .buy-button:hover {
            background-color: #e65b00;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #333;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #007BFF;;
           
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-delete {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .button-delete:hover {
            background-color: #d32f2f;
        }

        .error {
            color: #f44336;
            font-weight: bold;
        }

        .container {
            text-align: center;
            /* Centraliza o título e o contêiner de texto */
        }
 

.title {
  font-family: 'Roboto', sans-serif; /* Usando a fonte Roboto */
  font-size: 36px; /* Ajuste o tamanho da fonte conforme necessário */
  font-weight: 700; /* Define o peso da fonte (negrito) */
  color: #333; /* Cor do texto */
  margin-bottom: 20px; /* Espaçamento entre o título e o contêiner de texto */
}

.text-container {
  display: flex;
  gap: 20px; /* Espaçamento entre os botões */
  justify-content: center; /* Alinha os botões no centro da div */
  flex-wrap: wrap; /* Permite que os botões se movam para a linha seguinte se necessário */
}

.text-box {
  width: 300px; /* Ajuste o tamanho dos botões conforme necessário */
  padding: 15px; /* Adiciona algum preenchimento interno */
  border: 2px solid #ccc; /* Borda cinza */
  border-radius: 8px; /* Adiciona bordas arredondadas */
  background-color: transparent; /* Fundo transparente */
  color: #333; /* Cor do texto */
  font-family: 'Arial', sans-serif; /* Fonte do texto dos botões */
  cursor: pointer; /* Adiciona o cursor de ponteiro ao passar sobre o botão */
  text-align: center; /* Centraliza o texto dentro dos botões */
  box-shadow: none; /* Remove a sombra para um estilo mais limpo */
  transition: background-color 0.3s; /* Adiciona um efeito de transição suave */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.text-box:hover {
  background-color: transparent; /* Mantém o fundo transparente ao passar o mouse */
}

.main-text {
  font-family: 'Roboto', sans-serif; /* Fonte mais forte para o texto principal */
  font-size: 18px; /* Tamanho da fonte para o texto principal */
  font-weight: 700; /* Peso da fonte para o texto principal */
  color: #007BFF; /* Cor do texto principal */
}

.sub-text {
  font-family: 'Arial', sans-serif; /* Fonte normal para o texto secundário */
  font-size: 14px; /* Tamanho da fonte para o texto secundário */
  font-weight: 400; /* Peso da fonte para o texto secundário */
  color: #333; /* Cor do texto secundário */
}
.footer {
    background-color: rgba(255, 255, 255, 0.9); /* Fundo branco transparente */
    color: #333; /* Cor do texto */
    padding: 20px; /* Espaçamento interno */
    text-align: center; /* Centraliza o texto */
    font-family: 'Arial', sans-serif; /* Fonte do texto */
    font-size: 14px; /* Tamanho da fonte */
    border-top: 1px solid #ccc; /* Borda superior cinza clara */
    position: relative; /* Garante que o rodapé fique no final da página */
    bottom: 0;
    width: 100%; /* Largura total */
}

.footer p {
    margin: 10px 0; /* Espaçamento entre os parágrafos */
}

    </style>
</head>

<body>
    <header>
        <div>
            <img src="./logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="./index.html">Página inicial</a></li>
                <a href="minhaconta.php"></a><li><a href="./">Minha Conta</a></li>
                <li><a href="./contato.php">Contato</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <h1>Vagas Disponiveis

        </h1>

        <div class="jobs-wrap">
    <?php
    $hasResults = false;
    foreach ($jobs as $job) {
        $jobTitle = strtolower($job['title']);
        $jobLocation = strtolower($job['location']);
        if (strpos($jobTitle, $searchValue) !== false || strpos($jobLocation, $searchValue) !== false) {
            echo '
            <div class="job-item">
                <div class="company-logo">
                    <img src="./localizaçao.png" alt="Logo">
                </div>
                <div class="job-details">
                    <h3>' . htmlspecialchars($job['title']) . '</h3>
                    <p>' . htmlspecialchars($job['location']) . '</p>
                </div>
                <button class="buy-button" onclick="window.location.href=\'formulario_pagamento.php\';">Comprar</button>
            </div>
            ';
            $hasResults = true;
        }
    }
    ?>
</div>


        </div>

        <div class="text-container">
            <h1 class="title">Olá, acompanhe seus benefícios:</h1>
            <button class="text-box">
                <span class="main-text">Plano de saúde e benefício empresa</span><br>
                <span class="sub-text">Plano de saúde e benefício empresa</span>
            </button>
            
            <button class="text-box">
                <span class="main-text">Cupons!</span><br>
                <span class="sub-text">Cupons incríveis para economizar ainda mais!</span>
            </button>
        
            <button class="text-box">
                <span class="main-text">Ganhe Pontos</span><br>
                <span class="sub-text">Cupons incríveis para economizar ainda mais!</span>
            </button>
           
   





        <div class="container">
            <h1>Adicionar Comentário</h1>
            <form method="post" action="">
                <input type="text" name="nome" placeholder="Seu nome" required><br>
                <textarea name="comentario" rows="4" cols="50" required placeholder="Seu comentário"></textarea><br>
                <input type="submit" value="Enviar Comentário">
            </form>

            <h2>Comentários</h2>
            <ul>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li>
                            <strong>' . htmlspecialchars($row['nome']) . ':</strong> ' . htmlspecialchars($row['comentario']) . '
                            <a href="?delete_id=' . $row['id'] . '" class="button-delete">Deletar</a>
                        </li>';
                    }
                } else {
                    echo '<li>Sem comentários ainda.</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="footer">
    <p>
        A [Parkio] segue as determinações da Lei de Proteção de Dados e garante a segurança e a privacidade dos seus dados.
    </p>
    <p>
        [Parkiio] | CNPJ: [00.000.000/0000-00] | Endereço: [Rua Exemplo, 123] | Cidade - [Estado] | CEP [00000-000] | Para dúvidas e informações, entre em contato conosco através do nosso atendimento online.
    </p>
    <p>
        O estacionamento está disponível para todos os clientes durante o horário de funcionamento. Por favor, consulte as regras de uso no local.
    </p>
    <p>
        Política de privacidade | © 2024 [Nome da Empresa]. Todos os direitos reservados.
    </p>
</div>


    <?php $conn->close(); ?>
</body>

</html>