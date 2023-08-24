<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Emprestados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>
    <div class="back-button">
        <a href="adm.php">&lt; Voltar</a>
    </div>

    <h1>Livros Emprestados</h1>
    
    <?php
    session_start();
    if (!isset($_SESSION["nome_usuario"])) {
        header("Location: cadastro_professor.html");
        exit;
    }

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Consulta para recuperar os livros emprestados
    $sql_emprestados = "SELECT * FROM emprestimos WHERE status = 'emprestado'";
    $result_emprestados = mysqli_query($conn, $sql_emprestados);

    if (mysqli_num_rows($result_emprestados) > 0) {
        echo "<table>";
        echo "<tr><th>Código do Livro</th><th>Nome do Aluno</th><th>Matrícula do Aluno</th><th>Data de Retirada</th><th>Data de Entrega</th></tr>";
        while ($row = mysqli_fetch_assoc($result_emprestados)) {
            echo "<tr>";
            echo "<td>" . $row['codigo_livro'] . "</td>";
            echo "<td>" . $row['nome_aluno'] . "</td>";
            echo "<td>" . $row['matricula'] . "</td>";
            echo "<td>" . $row['data_retirada'] . "</td>";
            echo "<td>" . $row['data_entrega'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum livro emprestado no momento.</p>";
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>
</html>
