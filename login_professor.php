<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Professor</title>
    <style>
        body {
            background: linear-gradient(to bottom, #20C475, white);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #e0e0e0;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
        }

        .input-group {
            margin-bottom: 10px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .button {
            padding: 10px 20px;
            font-size: 18px;
            margin-top: 10px;
            background-color: #20C475;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover{
            background-color: #15a35e;
            transition: 0.5s;
        }

        .signup-link a{
            margin-top: 10px;
            font-size: 14px;
            color: #20C475;
        }
        .signup-link a:hover{
            color: #15a35e;
            transition: 0.5s;
        }
        h2{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 40px;
        }
    </style>
</head>
<body>
    <?php
    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter as informações do formulário
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $codigoAcesso = $_POST["codigo_acesso"];

        // Conectar ao banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "bibliotech";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar a conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Preparar e executar a consulta SQL para verificar as informações de login
        $sql = "SELECT * FROM professores WHERE nome = '$nome' AND email = '$email' AND codigo_acesso = '$codigoAcesso'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // As informações de login são válidas, redirecionar para a página "adm.html"
            session_start();
            $_SESSION["nome_usuario"] = $nome; // Armazena o nome como nome de usuário na sessão
            header("Location: adm.php");
            exit;
        } else {
            // As informações de login são inválidas, exibir mensagem de erro
            echo "Nome, email ou código de acesso inválidos.";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
    ?>
    <div class="container">
        <h2>Login de Professor</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="codigo_acesso">Código de Acesso:</label>
                <input type="password" id="codigo_acesso" name="codigo_acesso" required>
            </div>
            <button class="button" type="submit">Entrar</button>
            <div class="signup-link">
                <a href="cadastro_professor.html">Criar uma conta</a>
            </div>
        </form>
    </div>
</body>
</style>
<script>
    function redirecionar() {
        window.location.href = "adm.php";
    }
</script>
</html>