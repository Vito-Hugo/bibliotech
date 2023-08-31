<!DOCTYPE html>
<html lang="pt-br">
<head>
    <style>
body {             font-family: Arial, sans-serif;             margin: 0;             padding: 0;             background-color: #f2f2f2;         }          header {             background-color: #20C475;             color: #fff;             p</head>
    </style>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
        $loanIdToDelete = $_POST["delete"];

        // Delete the selected loan from the database
        $sqlDeleteLoan = "DELETE FROM emprestimos WHERE id = '$loanIdToDelete'";
        if (mysqli_query($conn, $sqlDeleteLoan)) {
            // Success message or additional actions can be added here
        } else {
            // Error message or handling can be added here
        }
    }

    mysqli_close($conn);
    ?>

    <h1>Histórico de Empréstimos</h1>
    <table>
        <tr>
            <th>Código do Livro</th>
            <th>Nome do Aluno</th>
            <th>Data de Retirada</th>
            <th>Data de Entrega</th>
            <th>Ação</th>
        </tr>
        <?php
        if ($resultLoanHistory && mysqli_num_rows($resultLoanHistory) > 0) {
            while ($row = mysqli_fetch_assoc($resultLoanHistory)) {
                echo "<tr>";
                echo "<td>" . $row["codigo_livro"] . "</td>";
                echo "<td>" . $row["nome_aluno"] . "</td>";
                echo "<td>" . $row["data_retirada"] . "</td>";
                echo "<td>" . $row["data_entrega"] . "</td>";
                echo "<td>
                        <form method='POST'>
                            <input type='hidden' name='delete' value='" . $row["id"] . "'>
                            <button type='submit'>Excluir</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum empréstimo encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
