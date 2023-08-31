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

    // Consulta para obter o histórico de livros retirados com o nome do livro
    $sql = "SELECT r.livro_nome, r.data_retirada, r.matricula, l.nome AS nome_livro FROM retiradas r
            LEFT JOIN livros l ON r.livro_nome = l.codigo";
    $result = mysqli_query($conn, $sql);

    if ($result !== false) {
        if (mysqli_num_rows($result) > 0) {
            // Exibe a tabela com o histórico dos livros
            echo "<table>";

            while ($row = mysqli_fetch_assoc($result)) {
                $livro_nome = !empty($row['nome_livro']) ? $row['nome_livro'] : "Nome não disponível";

                echo "<tr>";
                echo "<td>" . htmlspecialchars($livro_nome) . "</td>"; // Use htmlspecialchars para exibir corretamente
                echo "<td>" . htmlspecialchars($row['data_retirada']) . "</td>";
                echo "<td>" . htmlspecialchars($row['matricula']) . "</td>";
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