<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliar Estacionamento</title>
    <style>

    </style>
</head>
<body>

<header>
    <h1>Avaliar Estacionamento</h1>
</header>

<div class="container">
    <div class="form-container">
        <h2>Deixe sua avaliação</h2>
        <form method="POST" action="avaliar.php">
            <label for="usuario_id">ID do Usuário:</label>
            <input type="text" name="usuario_id" required><br>

            <label for="estacionamento_id">ID do Estacionamento:</label>
            <input type="text" name="estacionamento_id" required><br>

            <label for="nota">Nota (1 a 5):</label>
            <input type="number" name="nota" min="1" max="5" required><br>

            <label for="comentario">Comentário:</label>
            <textarea name="comentario" rows="4" required></textarea><br>

            <input type="submit" value="Enviar Avaliação">
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Parkio. Todos os direitos reservados.</p>
</footer>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parkio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['usuario_id'];
    $estacionamento_id = $_POST['estacionamento_id'];
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    // Inserir avaliação no banco de dados
    $sql = "INSERT INTO avaliacoes (usuario_id, estacionamento_id, nota, comentario) 
            VALUES ('$usuario_id', '$estacionamento_id', '$nota', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Avaliação inserida com sucesso!</p>";
    } else {
        echo "<p>Erro: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>

</body>
</html>
