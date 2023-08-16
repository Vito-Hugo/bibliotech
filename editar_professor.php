<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Professor</title>
    <style>
        /* Estilos CSS */

    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["nome_usuario"])) {
        header("Location: cadastro_professor.html");
        exit;
    }
    $nomeUsuario = $_SESSION["nome_usuario"];

    // Função para atualizar os dados do professor
    function atualizarDadosProfessor($id, $nome, $email, $cpf, $disciplina)
    {
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

        // Atualizar os dados do professor na tabela
        $sql = "UPDATE professores SET nome = '$nome', email = '$email', cpf = '$cpf', disciplina = '$disciplina' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Os dados do professor foram atualizados com sucesso.</p>";
        } else {
            echo "<p>Ocorreu um erro ao atualizar os dados do professor: " . $conn->error . "</p>";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }

    // Verificar se o formulário de edição foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter os dados do formulário
        $idProfessor = $_POST["id"];
        $nomeProfessor = $_POST["nome"];
        $emailProfessor = $_POST["email"];
        $cpfProfessor = $_POST["cpf"];
        $disciplinaProfessor = $_POST["disciplina"];

        // Atualizar os dados do professor no banco de dados
        atualizarDadosProfessor($idProfessor, $nomeProfessor, $emailProfessor, $cpfProfessor, $disciplinaProfessor);
    } else {
        echo "<p>Não foi enviado nenhum formulário de edição.</p>";
    }
    ?>

</body>
</html>