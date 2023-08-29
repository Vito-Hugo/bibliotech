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

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$livro = $_POST['livro'];
$aluno = $_POST['aluno'];
$dataRetirada = date("Y-m-d"); // Data atual

// Verifica se o livro existe no banco de dados
$verificaLivro = "SELECT * FROM livros WHERE nome = '$livro'";
$resultLivro = mysqli_query($conn, $verificaLivro);

if (mysqli_num_rows($resultLivro) > 0) {
    // Verifica se o aluno existe no banco de dados
    $verificaAluno = "SELECT * FROM alunos WHERE nome = '$aluno'";
    $resultAluno = mysqli_query($conn, $verificaAluno);
    
    if (mysqli_num_rows($resultAluno) > 0) {
        // Ambos livro e aluno existem, realizar a retirada
        $sql = "INSERT INTO retiradas (livro_nome, aluno_nome, data_retirada) VALUES ('$livro', '$aluno', '$dataRetirada')";
    
        if (mysqli_query($conn, $sql)) {
            echo "Livro retirado com sucesso!";
            header("Location: clube_livro.php");
        } else {
            echo "Erro ao retirar o livro: " . mysqli_error($conn);
        }
    } else {
        echo "Aluno não encontrado no sistema.";
    }
} else {
    echo "Livro não encontrado no sistema.";
}

mysqli_close($conn);
?>
