<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

if (isset($_GET['codigo'])) {
    $livroCodigo = $_GET['codigo'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM livros WHERE codigo = '$livroCodigo'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $livro = mysqli_fetch_assoc($result);
    } else {
        die("Livro não encontrado.");
    }

    mysqli_close($conn);
} else {
    die("Código do livro não especificado na URL.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- ... (cabeçalho) ... -->
</head>
<body>
    <header>
        <!-- ... (cabeçalho) ... -->
    </header>
    <div class="container">
        <h2>Editar Livro</h2>
        <form action="atualizar_livro_todo.php" method="post" enctype="multipart/form-data">
            <!-- Campos do formulário preenchidos com as informações do livro -->
            <label for="nome">Nome do Livro:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $livro['nome']; ?>">

            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" value="<?php echo $livro['autor']; ?>">

            <label for="classiicacao">Classificação</label>
            <input type="text" id="classificacao" name="classificacao" value="<?php echo $livro['classificacao'];?>">

            <label for="paginas">Páginas:</label>
            <input type="number" id="paginas" name="paginas" value="<?php echo $livro['paginas']; ?>">

            <label for="ano">Ano de Publicação:</label>
            <input type="number" id="ano" name="ano" value="<?php echo $livro['ano']; ?>">

            <label for="editora">Editora:</label>
            <input type="text" id="editora" name="editora" value="<?php echo $livro['editora']; ?>">

            <label for="idioma">Idioma:</label>
            <input type="text" id="idioma" name="idioma" value="<?php echo $livro['idioma']; ?>">

            <label for="posicao">Posição do Livro:</label>
            <input type="text" id="posicao" name="posicao" value="<?php echo $livro['posicao']; ?>">

            <label for="codigo">Código:</label>
            <input type="number" id="codigo" name="codigo" value="<?php echo $livro['codigo']; ?>">
          
            <input type="hidden" name="livro_codigo" value="<?php echo $livro['codigo']; ?>">
            <button type="submit">Salvar Alterações</button>

            <label for="foto">Foto Atual:</label>
            <img src="<?php echo $livro['imagens']; ?>" alt="Foto do Livro" width="150">

            <label for="nova_foto">Nova Foto:</label>
            <input type="file" id="nova_foto" name="nova_foto">

        </form>
    </div>
</body>
</html>