<?php
if (isset($_GET['id'])) {
    $professorId = $_GET['id'];

    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verificar se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Excluir o professor do banco de dados
        $sql = "DELETE FROM professores WHERE id = '$professorId'";
        
        if ($conn->query($sql) === TRUE) {
            // Redirecionar para a página de listagem de professores após a exclusão
            header("Location: professores.php");
            exit;
        } else {
            echo "Erro ao excluir professor: " . $conn->error;
        }
    }
    
    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID do professor não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Professor</title>
</head>
<body>
    <h2>Excluir Professor</h2>
    <p>Tem certeza de que deseja excluir este professor?</p>
    <form method="POST">
        <button type="submit">Confirmar Exclusão</button>
        <a href="professores.php">Cancelar</a>
    </form>
</body>
</html>
