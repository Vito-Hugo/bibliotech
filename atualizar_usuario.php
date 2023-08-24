<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $usuarioId = $_POST["id"];
    $novoNome = $_POST["nome"];
    $novoEmail = $_POST["email"];
    $novaMatricula = $_POST["matricula"];
    $novaTurma = $_POST["turma"];

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

    // Atualizar os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome='$novoNome', email='$novoEmail', matricula='$novaMatricula', turma='$novaTurma' WHERE id=$usuarioId";

    if ($conn->query($sql) === TRUE) {
        header('Location: usuarios.php');
    } else {
        echo "Erro ao atualizar o usuário: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    echo "Método inválido.";
}
?>
