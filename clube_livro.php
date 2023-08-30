<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração da Biblioteca</title>
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
            margin: 80px;
            
        }

        .form-container {
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Alinhar os formulários no topo */
        margin-top: -532px;
        margin-left: 320px;
    }

form {
        width: 400px;
        padding: 95px 60px 110px 30px;
        background-color: #e6e5e5;
        border-radius: 10px;
        box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
    }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="date"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        form .input-group {
            display: flex;
           
        }

        form button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #20C475;
            color: #ffffff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-top: 20px;
            
        }

        .box-container {
            display: flex;
            flex-direction: column; /* Alterado para exibir os boxes em coluna */
            align-items: flex-start; /* Alinha os boxes à esquerda */
            margin-bottom: 0px;
            margin-left: 50px;
        }

        .box {
            width: 200px;
            padding: 20px;
            background: linear-gradient(to bottom, #20C475, white);
            margin-right: 55px;
            margin-left: 70px;
            border-radius: 10px; 
            box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
        }
        
        p {
            font-size: 50px;
            margin: 0;
        }
        
        .user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }

        .user-info span {
            margin-right: 10px;
            font-weight: bold;
        }

        .user-info a {
            color: #fff;
            text-decoration: none;
            background-color: #e32636;
            padding: 5px;
            border-radius: 10px;
        }

    
    </style>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION["nome_usuario"])) {
        header("Location: cadastro_professor.html");
        exit;
    }
    $nomeUsuario = $_SESSION["nome_usuario"];
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Consulta para recuperar a quantidade de livros cadastrados
    $sqlLivros = "SELECT COUNT(*) AS totalLivros FROM livros";
    $resultLivros = mysqli_query($conn, $sqlLivros);
    $rowLivros = mysqli_fetch_assoc($resultLivros);
    $quantidadeLivros = $rowLivros['totalLivros'];

    // Consulta para recuperar a quantidade de livros retirados
    $sqlRetiradas = "SELECT COUNT(*) AS totalRetiradas FROM retiradas";
    $resultRetiradas = mysqli_query($conn, $sqlRetiradas);
    $rowRetiradas = mysqli_fetch_assoc($resultRetiradas);
    $quantidadeRetiradas = $rowRetiradas['totalRetiradas'];

    // Fechando a conexão com o banco de dados
    mysqli_close($conn);
?>
    <header>
        <h1>Administração da Biblioteca</h1>
        <div class="user-info">
            <span>Bem-vindo, <?php echo $nomeUsuario; ?></span>
            <a href="logout.php">Sair</a>
        </div>
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
        <div class="box-container">
           
        <div class="box">
            <h2>Livros</h2>
            <p><?php echo $quantidadeLivros; ?></p>
        </div>
        <div class="box">
            <h2>Retirados</h2>
            <p><?php echo $quantidadeRetiradas; ?></p>
        </div>

            <div class="box">
                <h2>Atrasados</h2>
                <p>5</p>
            </div>
        </div>
        <div class="form-container">
            <form method="POST" action="retirada_livros.php">
                <h2>Retirada de Livros</h2>
                <label for="livro">Codigo do Livro:</label>
                <input type="text" name="livro" id="livro" required>

                
                <div class="input-group">
                <label for="matricula">Matrícula:</label>
                <input type="number" name="matricula" id="matricula" maxlength="10" required><br>
            </div>

                <button type="submit">Retirar Livro</button>
                <form method="POST" action="historico_livros.php">
                <!-- Here you can add any additional input fields if needed -->
                <button type="submit"><a href="historico_livros.php"> Ver Histórico</a></button>
            </form>
            </form>
            
        </div>
    </div>
</body>
</html>
