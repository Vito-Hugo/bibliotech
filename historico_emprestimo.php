<!DOCTYPE html>
<html lang="pt-br">
<head>
    <style>
body, h1, table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

h1 {
    text-align: center;
    padding: 20px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #20C475;
    color:#ffffff;
}

td {
    vertical-align: middle;
}

button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #c82333;
}
.button-container {
    text-align: left;
    margin-left: 20px;
    margin-top: 20px;
}

.back-button {
    background-color: #20C475;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
}

.back-button:hover {
    background-color: #179457;
}
header{
            background-color: #ccc;
            box-shadow:black 0px 5px 5px black;
            text-align: center;
        }
</style>
 </head>
    <body>
    <header>
        <img src="./img/logo.png" alt="" width="200" height="50">
    </header>
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
    <div class="button-container">
        <a class="back-button" href="adm.php">Voltar</a>
    </div>
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