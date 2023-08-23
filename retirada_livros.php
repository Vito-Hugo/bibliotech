<?php
session_start();
if (!isset($_SESSION["nome_usuario"])) {
    header("Location: cadastro_professor.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livro = $_POST["livro"];
    $aluno = $_POST["aluno"];
    
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Verificar se o livro existe e se está disponível
    $sql_check = "SELECT id FROM livros WHERE nome = '$livro' AND disponivel = 1";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $row = mysqli_fetch_assoc($result_check);
        $livro_id = $row['id'];
        
        // Realizar o empréstimo
        $data_emprestimo = date("Y-m-d");
        $data_devolucao = date("Y-m-d", strtotime("+14 days"));
        
        $sql_emprestimo = "INSERT INTO emprestimos (livro_id, aluno_nome, data_emprestimo, data_devolucao) 
                           VALUES ('$livro_id', '$aluno', '$data_emprestimo', '$data_devolucao')";
        $result_emprestimo = mysqli_query($conn, $sql_emprestimo);
        
        if ($result_emprestimo) {
            // Marcar o livro como indisponível
            $sql_update_livro = "UPDATE livros SET disponivel = 0 WHERE id = '$livro_id'";
            $result_update_livro = mysqli_query($conn, $sql_update_livro);
            
            if ($result_update_livro) {
                // Empréstimo realizado com sucesso
                header("Location: adm.php"); // Redirecionar para a página de administração
                exit;
            }
        }
    }
    
    // Caso ocorra algum erro
    mysqli_close($conn);
    echo "Erro ao realizar o empréstimo.";
}
?>