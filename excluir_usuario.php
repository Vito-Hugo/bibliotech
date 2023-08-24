<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $usuarioId = $_GET["id"];
    // Excluir o usuário com base no ID
    $sql = "DELETE FROM usuarios WHERE id = $usuarioId";
    if ($conn->query($sql) === TRUE) {
       header('Location: usuarios.php');
    } else {
        echo "Erro ao excluir o usuário: " . $conn->error;
    }
} else {
    echo "ID do usuário não fornecido.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
