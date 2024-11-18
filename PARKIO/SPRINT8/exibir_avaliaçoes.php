<?php
include 'db.php'; 

$estacionamento_id = $_GET['estacionamento_id']; 


$sql = "SELECT a.nota, a.comentario, a.data_avaliacao, u.nome 
        FROM avaliacoes a 
        JOIN usuarios u ON a.usuario_id = u.id 
        WHERE a.estacionamento_id = '$estacionamento_id' 
        ORDER BY a.data_avaliacao DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações do Estacionamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #004d99;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .avaliacao {
            background-color: #f1f1f1;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .nota {
            font-size: 18px;
            font-weight: bold;
        }

        .comentario {
            font-size: 16px;
            margin-top: 10px;
        }

        footer {
            background-color: #004d99;
            color: white;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Avaliações do Estacionamento</h1>
</header>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='avaliacao'>";
            echo "<div class='nota'>Nota: " . $row['nota'] . "/5</div>";
            echo "<div class='comentario'>" . $row['comentario'] . "</div>";
            echo "<div class='data'>Data: " . $row['data_avaliacao'] . "</div>";
            echo "<div class='usuario'>Avaliado por: " . $row['nome'] . "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhuma avaliação encontrada.</p>";
    }
    ?>
</div>

<footer>
    <p>&copy; 2024 Parkio. Todos os direitos reservados.</p>
</footer>

<?php
$conn->close();
?>

</body>
</html>