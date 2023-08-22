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

    // Excluir o professor do banco de dados
    $sql = "DELETE FROM professores WHERE id = '$professorId'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Professor excluído com sucesso.";
    } else {
        echo "Erro ao excluir professor: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID do professor não fornecido.";
}
?>
