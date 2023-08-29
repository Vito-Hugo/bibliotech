<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
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

        .input-group input,
        .input-group select {
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
        .login-link a{
            color: #20C475;
        }
        .login-link a:hover{
            color: #15a35e;
            transition: 0.5s;
        }
        h2{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 40px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Aluno</h2>
        
        <?php
        // Verificar se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Coleta os dados do formulário
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $matricula = $_POST["matricula"];
            $turma = $_POST["turma"];
            $senha = $_POST["senha"];

            // Configurações do banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "bibliotech";

            // Conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Prepara e executa a inserção no banco de dados
            $sql = "INSERT INTO usuarios (nome, email, matricula, turma, senha)
                    VALUES ('$nome', '$email', '$matricula',  '$turma', '$senha')";

            if ($conn->query($sql)) {
                echo '<div class="alert-success">Informações inseridas com sucesso!</div>';
            } else {
                echo "Erro ao inserir informações: " . $conn->error;
            }

            // Fecha a conexão
            $conn->close();
        }
        ?>
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-group">
                <label for="nome">Nome:</label>

                <input type="text" name="nome" required><br>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required><br>
            </div>
            <div class="input-group">
                <label for="matricula">Matrícula:</label>
                <input type="number" name="matricula" id="matricula" maxlength="10" required><br>
            </div>
            
            <div class="input-group">
                <label for="turma">Turma:</label>
                <input type="text" name="turma" required><br>
            </div>
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="text" name="senha" required><br>
            </div>
            <input type="submit" value="Enviar">
            <div class="login-link">
                <br>
                <a href="login_aluno.php">Já tenho uma conta</a>
                <br>
                <a href="cadastro_professor.html">Sou professor</a>
            </div>
        </form>
    </div>
    <script>
    document.getElementById("matricula").addEventListener("input", function() {
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10); // Limita a 10 dígitos
    }
});
</script>
</body>
</html>
