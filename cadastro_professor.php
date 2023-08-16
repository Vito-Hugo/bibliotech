<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o código de acesso é válido
    $codigoAcesso = $_POST["codigo"];
    if ($codigoAcesso != "121314") {
        echo "Código de acesso inválido.";
        exit;
    }

    // Obter os dados do formulário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $disciplina = $_POST["disciplina"];
    $email = $_POST["email"];

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

    // Preparar e executar a consulta SQL para inserir os dados na tabela
    $sql = "INSERT INTO professores (nome, cpf, disciplina, email, codigo_acesso) VALUES ('$nome', '$cpf', '$disciplina', '$email', '$codigoAcesso')";

    if ($conn->query($sql) === TRUE) {
        // Cadastro realizado com sucesso, redirecionar para a página "adm.html"
        header("Location: adm.php");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
    session_start();
    $_SESSION["nome_usuario"] = $nome;
    
    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>