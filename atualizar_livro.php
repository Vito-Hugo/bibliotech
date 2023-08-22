<!-- atualizar_livro.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Seus cabeçalhos aqui -->
</head>
<body>
    <?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'editar' && isset($_POST['livro_id'])) {
        $livro_id = $_POST['livro_id'];

        // Consulta para recuperar as informações do livro a ser editado
        $sql = "SELECT * FROM livros WHERE id = $livro_id";
        $result = mysqli_query($conn, $sql);
        $livro = mysqli_fetch_assoc($result);

        // Exibir um formulário para editar as informações do livro
        echo "<form method='post' action='processar_atualizacao.php'>
                <input type='hidden' name='livro_id' value='" . $livro['id'] . "'>
                <!-- Campos de edição do livro -->
                <input type='text' name='nome' value='" . $livro['nome'] . "'>
                <input type='text' name='autor' value='" . $livro['autor'] . "'>
                <!-- Resto dos campos... -->
                <button type='submit'>Atualizar Livro</button>
              </form>";
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>
</html>
