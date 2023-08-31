<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    <style>
                body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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

        .sidebar {
            background-color: #f2f2f2;
            width: 200px;
            height: 100vh;
            padding: 20px;
            float: left;
            box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            height: 100vh;
            max-height: calc(100vh - 60px); /* Adjust based on your header height */
            overflow-y: auto;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 20px;
        }
        .sidebar ul li a:hover {
            color: #20C475;
        }
        .sidebar ul img{
            margin-bottom: 20px;
        }

        .container {
            margin: 20px;
            overflow: hidden;
        }

        form {
            float: left;
            margin-left: 20px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #20C475;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-left: 30px;
            margin-top: 35px;
            border-radius: 5px;
        }

        .input-group {
            width: 50%;
            float: left;
            box-sizing: border-box;
            padding: 5px;
        }

        .input-group input[type="text"],
        .input-group input[type="number"],
        .input-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        @media (max-width: 600px) {
            .input-group {
                width: 100%;
            }
        }

    </style>
</head>
<body>
    <header>
        <h1>Administração da Biblioteca</h1>
    </header>
   
    <div class="sidebar">
        <ul>
            <img src="./img/logo.png" alt="" width="200" height="50">
            <li><a href="adm.php">Empréstimo</a></li>
            <li><a href="usuarios.php">Alunos</a></li>
            <li><a href="clube_livro.php">Clube do Livro</a></li>
            <li><a href="professores.php">Professores</a></li>
            <li><a href="cadastro_livro.php">Cadastro de Livros</a></li>
            <li><a href="livros.php">Livros</a></li>
        </ul>
    </div>
    <div class="container">

    <form method="POST" action="" enctype="multipart/form-data">
            <h2>Cadastro de livros</h2>
            <div class="input-group">
                <label for="nome">Nome do Livro:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-group">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required>
            </div>
            <div class="input-group">
                <label for="classificacao">Classificação Indicativa:</label>
                <input type="text" id="classificacao" name="classificacao" required>
            </div>
            <div class="input-group">
                <label for="paginas">Número de Páginas:</label>
                <input type="number" id="paginas" name="paginas" required>
            </div>
            <div class="input-group">
                <label for="ano">Ano de Publicação:</label>
                <input type="number" id="ano" name="ano" required>
            </div>
            <div class="input-group">
                <label for="editora">Editora:</label>
                <input type="text" id="editora" name="editora" required>
            </div>
            <div class="input-group">
                <label for="idioma">Idioma:</label>
                <input type="text" id="idioma" name="idioma" required>
            </div>
            <div class="input-group">
                <label for="posicao">Posição do Livro:</label>
                <input type="text" id="posicao" name="posicao" required>
            </div>
            <div class="input-group">
                <label for="sinopse">Sinopse:</label>
                <textarea id="sinopse" name="sinopse" required></textarea>
            </div>
            <div class="input-group">
                <label for="codigo">Codigo do livro:</label>
                <input type="number" id="codigo" name="codigo" required> 
            </div>
            <div class="input-group">
            <label for="imagens">imagens do Livro:</label>
            <input type="file" id="imagens" name="imagens">
        </div>
            
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "bibliotech";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        $codigo = $_POST["codigo"];
        $nome = $_POST["nome"];
        $autor = $_POST["autor"];
        $classificacao = $_POST["classificacao"];
        $paginas = $_POST["paginas"];
        $ano = $_POST["ano"];
        $editora = $_POST["editora"];
        $idioma = $_POST["idioma"];
        $posicao = $_POST["posicao"];
        $sinopse = $_POST["sinopse"];

        $targetDir = "uploads/"; // Diretório de destino para as imagens
        $targetFile = $targetDir . basename($_FILES["imagens"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!empty($_FILES["imagens"]["tmp_name"])) {
            $check = getimagesize($_FILES["imagens"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<p>O arquivo enviado não é uma imagens.</p>";
                $uploadOk = 0;
            }
        }
    
        // Move a imagens para o diretório de destino
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["imagens"]["tmp_name"], $targetFile)) {
                echo "<p>A imagens foi enviada com sucesso.</p>";
            } else {
                echo "<p>Ocorreu um erro ao enviar a imagens.</p>";
            }
        }
    
        $sql = "INSERT INTO livros (codigo, nome, autor, classificacao, paginas, ano, editora, idioma, posicao, sinopse, imagens)
        VALUES ('$codigo', '$nome', '$autor', '$classificacao', $paginas, $ano, '$editora', '$idioma', '$posicao', '$sinopse', '$targetFile')";

    
        if ($conn->query($sql) === TRUE) {
            echo "<p>Cadastro do livro realizado com sucesso.</p>";
        } else {
            echo "<p>Ocorreu um erro ao cadastrar o livro: " . $conn->error . "</p>";
        }
    
        $conn->close();
    }
    ?>

</body>
</html>
