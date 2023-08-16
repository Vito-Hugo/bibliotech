<?php
// Verifying if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting the form data
    $livro = $_POST['livro'];
    $aluno = $_POST['aluno'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Check if the livro exists in the database
    $livro = mysqli_real_escape_string($conn, $livro);
    $query = "SELECT * FROM livros WHERE nome = '$livro' AND quantidade > 0";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Livro found, update the database and show success message
        $query = "UPDATE livros SET quantidade = quantidade - 1 WHERE nome = '$livro'";
        if (mysqli_query($conn, $query)) {
            // Livro retirado successfully
            $msg = "Livro '$livro' retirado com sucesso!";
        } else {
            // Error in updating the database
            $msg = "Erro ao retirar o livro. Por favor, tente novamente mais tarde.";
        }
    } else {
        // Livro not found or no quantity left
        $msg = "O livro '$livro' não foi encontrado ou não está disponível para retirada.";
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the form page with the message as a GET parameter
    header("Location: retirada_livros.php?msg=" . urlencode($msg));
    exit;
}
?>
