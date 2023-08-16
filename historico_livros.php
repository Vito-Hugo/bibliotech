
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
            // Verifica se o arquivo de histórico existe
            if (file_exists('historico.json')) {
                // Lê o conteúdo do arquivo de histórico
                $historicoLivros = json_decode(file_get_contents('historico.json'), true);
                return $historicoLivros;
            } else {
                return array();
            }
        }

        // Obtém os dados do histórico de livros retirados
        $historicoLivros = obterHistoricoLivros();

        if (!empty($historicoLivros)) {
            // Exibe a tabela com o histórico dos livros
            echo "<table>";
            echo "<tr><th>Livro</th><th>Data de Retirada</th><th>Aluno</th></tr>";

            foreach ($historicoLivros as $livro) {
                echo "<tr>";
                echo "<td>" . $livro['livro'] . "</td>";
                echo "<td>" . $livro['data_retirada'] . "</td>";
                echo "<td>" . $livro['aluno'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum livro foi retirado ainda.";
        }
    ?>
</body>
</html>
