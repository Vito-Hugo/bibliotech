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
            margin: 20px;
            overflow: hidden;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            margin-left: 20px;
            align-items: center;
            background-color: #e6e5e5;
            padding: 20px 40px 20px 30px;
            border-radius: 10px;
            box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="date"] {
            width: 45%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        form .input-group {
            display: flex;
            justify-content: space-between;
        }

        form button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #20C475;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-top: 20px;
        }

        .box-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
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
    .success-message {
        color: #008000;
        font-weight: bold;
        font-size: 20px;
        margin-left: 20px;
        margin-top: 20px;
    }

    .error-message {
        color: #FF0000;
        font-weight: bold;
        font-size: 20px;
        margin-left: 20px;
        margin-top: 20px;
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"]) && isset($_POST["matricula"]) && isset($_POST["retirada"]) && isset($_POST["entrega"])) {
    $codigo = $_POST["codigo"];
    $matricula = $_POST["matricula"];
    $retirada = $_POST["retirada"];
    $entrega = $_POST["entrega"];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql_emprestimo = "INSERT INTO emprestimos (codigo_livro, nome_aluno, data_retirada, data_entrega)
                       VALUES ('$codigo', '$matricula', '$retirada', '$entrega')";

    if (mysqli_query($conn, $sql_emprestimo)) {
        echo "<p class='success-message'>Empréstimo realizado com sucesso.</p>";
    } else {
        echo "<p class='error-message'>Ocorreu um erro ao realizar o empréstimo: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
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
            <li><a href="#">Empréstimo</a></li>
            <li><a href="usuarios.php">Alunos</a></li>
            <li><a href="clube_livro.php">Clube do Livro</a></li>
            <li><a href="#">Projeto de Leitura</a></li>
            <li><a href="professores.php">Professores</a></li>
            <li><a href="cadastro_livro.php">Cadastro de Livros</a></li>
            <li><a href="livros.php">Livros</a></li>
        </ul>
    </div>
    <div class="box-container">
    <div class="box">
        <h2>Livros</h2>
        <p><?php echo $quantidadeLivros; ?></p>
    </div>
    <div class="box">
        <h2><a href="emprestados.php" style="color: inherit; text-decoration: none;">Emprestados</a></h2>
        <p><?php echo $quantidadeLivrosEmprestados; ?></p>
    </div>
    <div class="box">
        <h2>Atrasados</h2>
        <p>5</p>
    </div>
</div>
        
        <div class="form-container">
    <form method="POST" action="">
        <h2>Empréstimo</h2>
        <div class="input-group">
            <div>
                <label for="codigo">Código do Livro:</label>
                <input type="text" id="codigo" name="codigo" required>
            </div>
            <label for="matricula">Matrícula:</label>
            <input type="number" id="matricula" name="matricula" required>
        </div>
        <div class="input-group">
            <div>
                <label for="retirada">Data de Retirada:</label>
                <input type="date" id="retirada" name="retirada" required>
            </div>
            <div>
                <label for="entrega">Data de Entrega:</label>
                <input type="date" id="entrega" name="entrega" required>
            </div>
        </div>
        <button type="submit">Realizar Empréstimo</button>
    </form>

    <form method="POST" action="">
        <h2>Renovação de Empréstimo</h2>
        <div class="input-group">
            <div>
                <label for="codigo-renovar">Código do Livro:</label>
                <input type="text" id="codigo-renovar" name="codigo-renovar" required>
            </div>
            <div>
                <label for="aluno-renovar">Matrícula:</label>
                <input type="number" id="matricula" name="matricula" required>
            </div>
        </div>
        <div class="input-group">
            <div>
                <label for="retirada-renovar">Nova Data de Retirada:</label>
                <input type="date" id="retirada-renovar" name="retirada-renovar" required>
            </div>
            <div>
                <label for="entrega-renovar">Nova Data de Entrega:</label>
                <input type="date" id="entrega-renovar" name="entrega-renovar" required>
            </div>
        </div>
        <button type="submit">Renovar Empréstimo</button>
    </form>
</div>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado, caso contrário, redireciona para a página de login
if (!isset($_SESSION["nome_usuario"])) {
    header("Location: cadastro_professor.html");
    exit;
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Função para escapar caracteres especiais
function escape_input($conn, $input)
{
    return mysqli_real_escape_string($conn, $input);
}

// Verifica se o formulário de empréstimo foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"]) && isset($_POST["aluno"]) && isset($_POST["retirada"]) && isset($_POST["entrega"])) {
    $codigo = escape_input($conn, $_POST["codigo"]);
    $aluno = escape_input($conn, $_POST["aluno"]);
    $retirada = escape_input($conn, $_POST["retirada"]);
    $entrega = escape_input($conn, $_POST["entrega"]);

    // Insere os dados na tabela de empréstimos
    $sql_emprestimo = "INSERT INTO emprestimos (codigo_livro, nome_aluno, matricula_aluno ,data_retirada, data_entrega)
                       VALUES ('$codigo', '$aluno','matricula_aluno', '$retirada', '$entrega')";

    if (mysqli_query($conn, $sql_emprestimo)) {
        echo "<p class='success-message'>Empréstimo realizado com sucesso.</p>";
    } else {
        echo "<p class='error-message'>Ocorreu um erro ao realizar o empréstimo: " . mysqli_error($conn) . "</p>";
    }
}

// Verifica se o formulário de renovação foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo-renovar"]) && isset($_POST["aluno-renovar"]) && isset($_POST["retirada-renovar"]) && isset($_POST["entrega-renovar"])) {
    $codigo_renovar = escape_input($conn, $_POST["codigo-renovar"]);
    $aluno_renovar = escape_input($conn, $_POST["aluno-renovar"]);
    $retirada_renovar = escape_input($conn, $_POST["retirada-renovar"]);
    $entrega_renovar = escape_input($conn, $_POST["entrega-renovar"]);

    // Atualiza as informações de empréstimo na tabela de empréstimos
    $sql_renovar = "UPDATE emprestimos SET data_retirada='$retirada_renovar', data_entrega='$entrega_renovar'
                    WHERE codigo_livro='$codigo_renovar' AND nome_aluno='$aluno_renovar'";

    if (mysqli_query($conn, $sql_renovar)) {
        echo "<p class='success-message'>Renovação de empréstimo realizada com sucesso.</p>";
    } else {
        echo "<p class='error-message'>Ocorreu um erro ao renovar o empréstimo: " . mysqli_error($conn) . "</p>";
    }
}

// Fechando a conexão com o banco de dados
mysqli_close($conn);
?>


    </div>
</body>
</html>