<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Livros Retirados para o Clube do Livro</title>
    <style>
       
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        table {
            width: 97%;
            border-collapse: collapse;
            margin-left: 27px;
            margin-right: -90px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            
        }

        th {
            background-color: #20C475;
            color: #fff;
        }

        .user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #E32636;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            margin-left: 27px;
            margin-right: -90px;
        }

        .back-button:hover {
            background-color: #AA2732;
        }

        header {
        background-color: #ccc;
        box-shadow: black 0px 5px 5px black;
        margin: 0; /* Add this line to remove the margin */
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
    $sql = "SELECT livro_codigo, livro_nome, data_retirada, matricula FROM retiradas";
    $result = mysqli_query($conn, $sql);

    if ($result !== false) {
        if (mysqli_num_rows($result) > 0) {
            // Exibe a tabela com o histórico dos livros
            echo "<table>";

            while ($row = mysqli_fetch_assoc($result)) {
                // Obter o nome do livro correspondente ao código
                if (!empty($row['livro_codigo'])) {
                    $livro_codigo = $row['livro_codigo'];
                    $livro_nome_sql = "SELECT nome FROM livros WHERE codigo = '$livro_codigo'";
                    $livro_nome_result = mysqli_query($conn, $livro_nome_sql);
                    $livro_nome_row = mysqli_fetch_assoc($livro_nome_result);
                    $livro_nome = $livro_nome_row['nome'];
                } else {
                    $livro_nome = $row['livro_nome'];
                }

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
</html>
