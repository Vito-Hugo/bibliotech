<?php
// Coleta os dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$matricula = $_POST["matricula"];
$ano = $_POST["ano"];
$turma = $_POST["turma"];
$senha = $_POST["senha"];

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Prepara e executa a inserção no banco de dados
$sql = "INSERT INTO usuarios (nome, email, matricula, ano, turma, senha)
        VALUES ('$nome', '$email', '$matricula', $ano, '$turma', '$senha')";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("Location: login_aluno.html"); // Redireciona para a tela de login
    exit();
} else {
    echo "Erro ao inserir informações: " . $conn->error;
}

// Fecha a conexão
$conn->close();
?>