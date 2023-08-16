<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obter o ID do livro e a ação (adicionar ou remover) do formulário
    $livro_id = $_POST["livro_id"];
    $acao = $_POST["acao"];

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Verificar a ação selecionada e executar a ação apropriada
    if ($acao === "adicionar") {
        // Lógica para adicionar unidade
        $sql = "UPDATE livros SET unidade = unidade + 1 WHERE id = $livro_id";
        mysqli_query($conn, $sql);
    } elseif ($acao === "remover") {
        // Lógica para remover unidade
        $sql = "UPDATE livros SET unidade = unidade - 1 WHERE id = $livro_id";
        mysqli_query($conn, $sql);
    }

    // Redirecionar de volta para a página dos livros após a atualização
    header("Location: livros.php");
    exit();
}
?>