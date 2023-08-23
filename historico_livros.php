<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Livros Retirados</title>
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
    <h1>Histórico de Livros Retirados</h1>
    <?php
        // Função para obter o histórico de livros retirados
        function obterHistoricoLivros()
        {
            // Conectar ao banco de dados ou qualquer outra fonte de dados
            // Substitua este trecho pelo código de conexão e consulta apropriado
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "bibliotech";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta SQL para obter o histórico de livros retirados
            $sql = "SELECT livro, data_retirada, aluno FROM historico_livros";
            $result = $conn->query($sql);

            $historicoLivros = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $historicoLivros[] = array(
                        'livro' => $row['livro'],
                        'data_retirada' => $row['data_retirada'],
                        'aluno' => $row['aluno']
                    );
                }
            }

            $conn->close();

            return $historicoLivros;
        }

        // Obtém os dados do histórico de livros retirados
        $historicoLivros = obterHistoricoLivros();

    if (!empty($historicoLivros)) {
    echo "<table>";
    echo "<tr><th>Livro</th><th>Data de Retirada</th><th>Aluno</th></tr>";

    foreach ($historicoLivros as $livro) {
        // Verifica se $livro é um array antes de acessar suas propriedades
        if (is_array($livro)) {
            echo "<tr>";
            echo "<td>" . $livro['livro'] . "</td>";
            echo "<td>" . $livro['data_retirada'] . "</td>";
            echo "<td>" . $livro['aluno'] . "</td>";
            echo "</tr>";
        }
    }

    echo "</table>";
} else {
    echo "Nenhum livro foi retirado ainda.";
}
    ?>
</body>
</html>
