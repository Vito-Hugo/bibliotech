<?php
// Verificar se o ID do professor foi fornecido
if (isset($_POST["id"])) {
    $idProfessor = $_POST["id"];

    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "seu_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Excluir o professor da tabela
    $sql = "DELETE FROM professores WHERE id = $idProfessor";
    if ($conn->query($sql) === TRUE) {
        echo "O professor foi excluído com sucesso.";
    } else {
        echo "Ocorreu um erro ao excluir o professor: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID do professor não fornecido.";
}
?>