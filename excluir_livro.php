<?php
// Verificar se o ID do livro foi fornecido
if (isset($_POST["livro_id"])) {
    $livroId = $_POST["livro_id"];

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

    // Excluir o livro da tabela
    $sql = "DELETE FROM livros WHERE id = $livroId";
    if ($conn->query($sql) === TRUE) {
        echo "O livro foi excluído com sucesso.";
    } else {
        echo "Ocorreu um erro ao excluir o livro: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    header("Location: livros.php");
} else {
    echo "ID do livro não fornecido.";
}
?>
