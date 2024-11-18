<link rel="stylesheet" href="css/global/global.css">

<?php
function cancelarVaga($vagaId) {
   
    $host = 'localhost';
    $dbname = 'parkio';
    $username = 'root';
    $password = '';

    try {
     
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlCheck = "SELECT * FROM vagas WHERE id = :id";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':id', $vagaId, PDO::PARAM_INT);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() == 0) {
            return "Vaga não encontrada.";
        }

        $sqlUpdate = "UPDATE vagas SET status = 'cancelada' WHERE id = :id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':id', $vagaId, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            return "Vaga cancelada com sucesso.";
        } else {
            return "Erro ao cancelar a vaga.";
        }
    } catch (PDOException $e) {
        return "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}


$vagaId = 1; 
echo cancelarVaga($vagaId);
?>