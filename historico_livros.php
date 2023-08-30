<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Livros Retirados para o Clube do Livro</title>
    <style>
        /* Estilos CSS para o layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Histórico de Livros Retirados para o Clube do Livro</h1>
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

    // Consulta para obter o histórico de livros retirados
    $sql = "SELECT livro_nome, data_retirada, matricula FROM retiradas"; // Substituído para selecionar a matricula
    $result = mysqli_query($conn, $sql);

    if ($result !== false) {
        if (mysqli_num_rows($result) > 0) {
            // Exibe a tabela com o histórico dos livros
            echo "<table>";
            echo "<tr><th>Livro</th><th>Data de Retirada</th><th>Matrícula do Aluno</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['livro_nome'] . "</td>";
                echo "<td>" . $row['data_retirada'] . "</td>";
                echo "<td>" . $row['matricula'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum livro foi retirado ainda.";
        }

        // Fechando o resultado da consulta
        mysqli_free_result($result);
    } else {
        echo "Erro na consulta SQL: " . mysqli_error($conn);
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>
</html>
