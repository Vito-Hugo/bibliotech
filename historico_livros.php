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
 
     // Consulta para obter o histórico de livros retirados com o nome do livro
     $sql = "SELECT r.livro_nome, r.data_retirada, r.matricula, l.nome AS nome_livro FROM retiradas r
             LEFT JOIN livros l ON r.livro_nome = l.codigo";
     $result = mysqli_query($conn, $sql);
?>
     <div class="button-container">
        <a class="back-button" href="clube_livro.php">Voltar</a>
    </div>
    <h1>Histórico de Livros do Clube do Livro</h1>
    <table>
        <tr>
            <th>Nome do Livro</th>
            <th>Data de Retirada</th>
            <th>Matrícula</th>

        </tr>
    <?php
     if ($result !== false) {
         if (mysqli_num_rows($result) > 0) {

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
</table>
</body>
</html>