<link rel="stylesheet" href="css/global/global.css">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parkio";


// $conn = new mysqli($servername, $username, $password, $dbname);


///if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
//}
///

$usuario_id = 1; 


$sql = "SELECT id, data_compra, data_utilizacao FROM vagas_estacionamento WHERE usuario_id = ?";
///$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Vagas</title>
    <style>
    
    </style>
</head>
<body>

    <h1>Histórico de Vagas de Estacionamento</h1>

   
    <table>
    <thead>
            <tr>
                <th>ID da Vaga</th>
                <th>Data de Compra</th>
                <th>Data de Utilização</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($row['data_compra'])) . "</td>";
                    echo "<td>" . ($row['data_utilizacao'] ? date('d/m/Y', strtotime($row['data_utilizacao'])) : 'Não Utilizada') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhuma vaga comprada encontrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>

   
    <div class="button-container">
        <button onclick="window.history.back();">Voltar</button>
    </div>

</body>
</html>

<?php

$conn->close();
?>

