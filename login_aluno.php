<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Aluno</title>
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
        .alert-error {
            background-color: #f8d7da; /* Cor de fundo vermelha */
            color: #721c24; /* Cor do texto vermelho */
            border: 1px solid #f5c6cb; /* Borda vermelha */
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bibliotech";

    // Coleta os dados do formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        // Conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Verifica o login no banco de dados
        $sql = "SELECT * FROM usuarios WHERE Email = '$email' AND senha = '$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Login bem-sucedido, redireciona para a página vitrine.php
            header("Location: vitrine.php");
            exit();
        } else {
            echo '<div class="alert-error">Login falhou. Verifique suas credenciais.</div>';
        }

        // Fecha a conexão
        $conn->close();
    }
    ?>

    <div class="container">
        <h2>Login de Aluno</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button class="button" type="submit">Entrar</button>
            <div class="signup-link">
                <br>
                <a href="cadastro_aluno.php">Criar uma conta</a>
            </div>
        </form>
    </div>
</body>
</html>