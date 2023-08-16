<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

// Coleta os dados do formulário
$email = $_POST["email"];
$senha = $_POST["senha"];

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica o login no banco de dados
$sql = "SELECT * FROM usuarios WHERE Email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    echo "Login bem-sucedido!"; // Você pode redirecionar o usuário para a página desejada aqui
} else {
    echo "Login falhou. Verifique suas credenciais.";
}

// Fecha a conexão
$conn->close();
?>