<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retirada de Livros</title>
    <script>
    function showAlert(message, redirect) {
        alert(message);
        if (redirect) {
            window.location.href = redirect;
        }
    }
</script>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION["nome_usuario"])) {
    header("Location: cadastro_professor.html");
    exit;
}

// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo'); // Substitua pelo fuso horário correto

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
$livro = $_POST['livro'];
$livro = $_POST['codigo'];
$matricula = $_POST['matricula'];
$dataRetirada = date("Y-m-d"); // Data atual

// Verifica se o livro existe no banco de dados
$verificaLivro = "SELECT * FROM livros WHERE codigo = '$livro'";
$resultLivro = mysqli_query($conn, $verificaLivro);

if (mysqli_num_rows($resultLivro) > 0) {
    // Verifica se a matrícula existe no banco de dados
    $verificaMatricula = "SELECT * FROM usuarios WHERE matricula = '$matricula'";
    $resultMatricula = mysqli_query($conn, $verificaMatricula);
    
    if (mysqli_num_rows($resultMatricula) > 0) {
        // Livro e matrícula existem, realizar a retirada
        $sql = "INSERT INTO retiradas (livro_nome, matricula, data_retirada) VALUES ('$livro', '$matricula', '$dataRetirada')";
    
        if (mysqli_query($conn, $sql)) {
            echo "<script>showAlert('Livro retirado com sucesso!', 'clube_livro.php');</script>";
        } else {
            echo "<script>showAlert('Erro ao retirar o livro: " . mysqli_error($conn) . "', 'clube_livro.php');</script>";
        }
    } else {
        echo "<script>showAlert('Aluno não encontrado no sistema.', 'clube_livro.php');</script>";
    }
} else {
    echo "<script>showAlert('Livro não encontrado no sistema.', 'clube_livro.php');</script>";
}

mysqli_close($conn);
?>
</body>
</html>