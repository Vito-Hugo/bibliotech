<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Empréstimos</title>
    <!-- Add your CSS styles here -->
    <style>
       

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #20C475;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            margin: 20px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #20C475;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #20C475;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        a.button:hover {
            background-color: #1a8742;
        }
    </style>

</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Retrieve loan history from the database
    $sqlLoanHistory = "SELECT * FROM emprestimos ORDER BY data_retirada DESC";
    $resultLoanHistory = mysqli_query($conn, $sqlLoanHistory);

    mysqli_close($conn);
    ?>

    <h1>Histórico de Empréstimos</h1>
    <table>
        <tr>
            <th>Código do Livro</th>
            <th>Nome do Aluno</th>
            <th>Data de Retirada</th>
            <th>Data de Entrega</th>
        </tr>
        <?php
        if ($resultLoanHistory && mysqli_num_rows($resultLoanHistory) > 0) {
            while ($row = mysqli_fetch_assoc($resultLoanHistory)) {
                echo "<tr>";
                echo "<td>" . $row["codigo_livro"] . "</td>";
                echo "<td>" . $row["nome_aluno"] . "</td>";
                echo "<td>" . $row["data_retirada"] . "</td>";
                echo "<td>" . $row["data_entrega"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum empréstimo encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
