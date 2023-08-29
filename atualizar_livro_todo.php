<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['livro_codigo'])) {
        $livroCodigo = $_POST['livro_codigo'];

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        // Recuperar os dados do formulário
        $novoNome = $_POST['nome'];
        $novoAutor = $_POST['autor'];
        $novaClassificacao = $_POST['classificacao'];
        $novasPaginas = $_POST['paginas'];
        $novoAno = $_POST['ano'];
        $novaEditora = $_POST['editora'];
        $novoIdioma = $_POST['idioma'];
        $novaPosicao = $_POST['posicao'];
        $novoCodigo = $_POST['codigo'];

        
        if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] === 0) {
            $fotoTempName = $_FILES['nova_foto']['tmp_name'];
            $fotoName = $_FILES['nova_foto']['name'];
            $fotoPath = "img/" . $fotoName;
    
            // Move a foto para o diretório de destino
            if (move_uploaded_file($fotoTempName, $fotoPath)) {
                // Atualize o caminho da foto no banco de dados
                $updateSql = "UPDATE livros SET imagens = '$fotoPath' WHERE codigo = '$livroCodigo'";
                mysqli_query($conn, $updateSql);
            }
        }

        // Consulta para atualizar os detalhes do livro com base no código
        $sql = "UPDATE livros SET nome='$novoNome', autor='$novoAutor', classificacao='$novaClassificacao', paginas='$novasPaginas', ano='$novoAno', editora='$novaEditora', idioma='$novoIdioma', posicao='$novaPosicao', codigo='$novoCodigo' WHERE codigo='$livroCodigo'";
        
        if (mysqli_query($conn, $sql)) {
            // Atualização bem-sucedida
            mysqli_close($conn);
            header("Location: livros.php");
            exit();
        } else {
            // Erro na atualização
            echo "Erro na atualização: " . mysqli_error($conn);
            mysqli_close($conn);
        }
    } else {
        die("Código do livro não especificado.");
    }
} else {
    header("Location: livros.php");
    exit();
}
?>