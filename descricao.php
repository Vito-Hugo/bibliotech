<?php
session_start();

// Conexão com o banco de dados
$conexao = mysqli_connect('localhost', 'root', 'root', 'bibliotech');

// Verifica a conexão
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit();
}

// Verifique se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    // Consulta SQL para recuperar os dados do livro com base no ID
    $query = "SELECT * FROM livros WHERE id = '$livroId'";
    $result = mysqli_query($conexao, $query);

    // Verifique se o livro foi encontrado
    if ($row = mysqli_fetch_assoc($result)) {
        $nome = $row['nome'];
        $autor = $row['autor'];
        $imagens = $row['imagens'];
        $unidade = $row['unidade'];
        $sinopse = $row['sinopse'];
        $posicao = $row['posicao'];
    } else {
        // Caso o livro não seja encontrado, você pode exibir uma mensagem de erro ou redirecionar o usuário para uma página de erro
        $error_message = "Livro não encontrado.";
    }
} else {
    // Caso o parâmetro 'id' não seja passado na URL, você pode exibir uma mensagem de erro ou redirecionar o usuário para uma página de erro
    $error_message = "ID de livro não fornecido.";
}

// Feche a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Restante das meta tags, título e links de estilo -->
</head>
<style>
 body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            padding: 20px;
        }

        .book-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative; /* Para permitir o posicionamento absoluto do botão */
        }

        .book-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sinopse-box {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: left;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #20C475;
            color: #fff;
            border: none;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover{
            background-color: #1AB369;
            transition: 1s;
        }
/* Estilos de mídia */
@media (max-width: 600px) {
    .container {
        padding: 10px;
    }
}
</style>
<body>
    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    } else {
    ?>
    <div class="book-details">
    <button class="back-button" onclick="goBack()">Voltar</button>
    <img src="<?php echo $imagens; ?>" alt="">
    <h1><?php echo $nome; ?></h1>
    <p>Autor: <?php echo $autor; ?></p>
    <p>Unidade: <?php echo $unidade; ?></p>
    <p>Posição: <?php echo $posicao; ?></p> <!-- Mostra a posição do livro -->
    <div class="sinopse-box">
        <p><strong>Sinopse:</strong></p>
        <p><?php echo $sinopse; ?></p>
    </div>
</div>
    <?php
    }
    ?>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
