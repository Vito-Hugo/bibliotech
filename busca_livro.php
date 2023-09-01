<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h3 {
            color: #333;
            margin-top: 0;
        }

        p {
            color: #666;
            margin-bottom: 0;
        }

        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-left: 70px;
            margin-top: 20px;
        }

        .book {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 200px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .message {
            color: #666;
        }

        .btn{
            align-items: center;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="header-1">
        <a href="vitrine.php" class="logo"><i class="fas fa-book"></i> BliblioTech</a>
        <form action="busca_livro.php" class="search-form" method="GET">
    <select name="tipo-pesquisa">
        <option value="nome">Título</option>
        <option value="autor">Autor</option>
        <option value="letra">Letra</option>
    </select>
    <input type="search" name="livro-nome" placeholder="Procure aqui..." id="search-box">
    <button type="submit"><i class="fas fa-search"></i></button>
</form>

        <div class="icons">
            
        </div>
    </div>
    <div class="header-2">
        <nav class="navbar">
            <a href="#home"></a>
           
        </nav>
    </div>
</header>

<nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#destque" class="fas fa-list"></a>
    <a href="#lancamento" class="fas fa-tags"></a>
    <a href="#comentarios" class="fas fa-comments"></a>
    <a href="#contato" class="fas fa-blogs"></a>
</nav>

<?php
// Verifica se o parâmetro "livro-nome" foi passado na URL


if (isset($_GET['livro-nome']) && isset($_GET['tipo-pesquisa'])) {
    $livroNome = $_GET['livro-nome'];
    $tipoPesquisa = $_GET['tipo-pesquisa'];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";
    // Conecte-se ao banco de dados (substitua os valores pelos dados reais do seu banco)
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "";

    if ($tipoPesquisa === "autor") {
        // Consulta os livros pelo autor
        $sql = "SELECT * FROM livros WHERE autor LIKE '%$livroNome%'";
    } elseif ($tipoPesquisa === "letra") {
        // Consulta os livros por letra inicial do título
        $sql = "SELECT * FROM livros WHERE nome LIKE '$livroNome%'";
    } else {
        // Consulta os livros pelo título
        $sql = "SELECT * FROM livros WHERE nome LIKE '%$livroNome%'";
    }

    $result = $conn->query($sql);

    // Exibe os resultados da pesquisa
    if ($result->num_rows > 0) {
        echo '<div class="book-container">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="book">';
            echo '<h3>' . $row['nome'] . '</h3>';
            echo '<p>Autor: ' . $row['autor'] . '</p>';
            
            // Adicione um link à imagem que direciona para descricao.php com o ID do livro como parâmetro
            echo '<a href="descricao.php?id=' . $row['id'] . '"><img src="' . $row['imagens'] . '" alt="Capa do livro"></a>';
            
            // Adicione outras informações do livro aqui, se necessário
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="message">Nenhum livro encontrado.</p>';
    }
    

    $conn->close();
}
?>
</body>
</html>
