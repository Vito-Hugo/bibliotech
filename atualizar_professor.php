<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $professorId = $_POST["id"];
    $novoNome = $_POST["nome"];
    $novoEmail = $_POST["email"];
    $novoCpf = $_POST["cpf"];
    $novaMateria = $_POST["materia"]; // Lembre-se de adicionar o campo "materia" ao seu formulário

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

    // Atualizar os dados do professor no banco de dados
    $sql = "UPDATE professores SET nome='$novoNome', email='$novoEmail', cpf='$novoCpf', disciplina='$novaMateria' WHERE id=$professorId";

    if ($conn->query($sql) === TRUE) {
        header('Location: professores.php'); // Redirecionar para a página de lista de professores
    } else {
        echo "Erro ao atualizar o professor: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    echo "Método inválido.";
}
?>
