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
        margin-left: 350px;
    }


    form {
        width: 400px;
        margin: 0 10px;
        padding: 50px 60px 72px 30px;
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
            display: column;
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
            flex-direction: column; /* Exibe as caixas em coluna */
            align-items: flex-start; /* Alinha as caixas à esquerda */
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
 
 // Conexão com o banco de dados
 $servername = "localhost";
 $username = "root";
 $password = "root";
 $dbname = "bibliotech";
 
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 if (!$conn) {
     die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
 }
 
 // Verifica se o formulário de empréstimo foi enviado
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"]) && isset($_POST["aluno"]) && isset($_POST["retirada"]) && isset($_POST["entrega"])) {
     $codigoLivro = $_POST["codigo"];
     $nomeAluno = $_POST["aluno"];
     $dataRetirada = $_POST["retirada"];
     $dataEntrega = $_POST["entrega"];
     
     // Inserir os dados na tabela de empréstimos
     $sqlEmprestimos = "INSERT INTO emprestimos (codigo_livro, nome_aluno, data_retirada, data_entrega) VALUES ('$codigoLivro', '$nomeAluno', '$dataRetirada', '$dataEntrega')";
     
     if (mysqli_query($conn, $sqlEmprestimos)) {
         $successMessage = "Empréstimo realizado com sucesso!";
     } else {
         $errorMessage = "Erro ao realizar o empréstimo: " . mysqli_error($conn);
     }
 }
 
 // Consulta para recuperar a quantidade de livros cadastrados
 $sqlQuantidadeLivros = "SELECT COUNT(*) AS unidade FROM livros";
 $resultQuantidadeLivros = mysqli_query($conn, $sqlQuantidadeLivros);
 $rowQuantidadeLivros = mysqli_fetch_assoc($resultQuantidadeLivros);
 $quantidadeLivros = $rowQuantidadeLivros['unidade'];

$sqlQuantidadeEmprestimos = "SELECT COUNT(*) AS quantidade FROM emprestimos";
$resultQuantidadeEmprestimos = mysqli_query($conn, $sqlQuantidadeEmprestimos);
$rowQuantidadeEmprestimos = mysqli_fetch_assoc($resultQuantidadeEmprestimos);
$quantidadeEmprestimos = $rowQuantidadeEmprestimos['quantidade'];
 
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
            <li><a href="#">Empréstimo</a></li>
            <li><a href="usuarios.php">Alunos</a></li>
            <li><a href="clube_livro.php">Clube do Livro</a></li>
            <li><a href="#">Projeto de Leitura</a></li>
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
            <br>
            <div class="box">
                <h2>Emprestados</h2>
                <p><?php echo $quantidadeEmprestimos; ?></p>
            </div>
            <br>
            <div class="box">
                <h2>Atrasados</h2>
                <p>5</p>
            </div>
        <div class="form-container">
    <form action="" method="POST">
        <h2>Empréstimo</h2>
        <div class="input-group">
            <div>
                <label for="codigo">Código do Livro:</label>
                <input type="text" id="codigo" name="codigo" required>
            </div>
            <div>
                <label for="aluno">Nome do Aluno:</label>
                <input type="text" id="aluno" name="aluno" required>
            </div>
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
        <button type="submit" name="emprestimoSubmit">Realizar Empréstimo</button>
            <div class="history-button">
                <a href="historico_emprestimo.php">Ver Histórico de Empréstimos</a>
            </div>
    </form>

    <form action="" method="POST">
        <h2>Renovação de Empréstimo</h2>
        <div class="input-group">
            <div>
                <label for="codigo-renovar">Código do Livro:</label>
                <input type="text" id="codigo-renovar" name="codigo-renovar" required>
            </div>
            <div>
                <label for="aluno-renovar">Nome do Aluno:</label>
                <input type="text" id="aluno-renovar" name="aluno-renovar" required>
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
       <button type="submit" name="renovacaoSubmit">Renovar Empréstimo</button>
    </form>
</div>
    </div>
</body>
</html>