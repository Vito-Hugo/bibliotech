<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-top: 20px;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input {
            width: 95%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            
        }

        #atualizarButton {
            background-color: #20C475;
            color: #fff;
        }

        #cancelarButton {
            background-color: #E32636;
            color: #fff;
        }    
        header{
            background-color: #ccc;
            box-shadow:black 0px 5px 5px black;
        }
        </style>
</head>
<body>
    <?php
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

    if (isset($_GET["id"])) {
        $usuarioId = $_GET["id"];
        // Recuperar os dados do usuário com base no ID
        $sql = "SELECT * FROM usuarios WHERE id = $usuarioId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "ID do usuário não fornecido.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>
<header>
    <img src="./img/logo.png" alt="" width="200" height="50">
</header>
    <h2>Editar Usuário</h2>
    <form action="atualizar_usuario.php" method="post">
        <input type="hidden" name="id" value="<?php echo $usuarioId; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>

        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" value="<?php echo $usuario['matricula']; ?>" required><br>

        <label for="turma">Turma:</label>
        <input type="text" id="turma" name="turma" value="<?php echo $usuario['turma']; ?>"><br>

        <button type="submit" id="atualizarButton">Atualizar</button>
        <button type="button" id="cancelarButton" onclick="voltarPagina()">Cancelar</button>
    </form>
    <script>
        function voltarPagina() {
            window.history.back();
        }
        document.getElementById("cpf").addEventListener("input", function() {
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11); // Limita a 11 caracteres
            }
        });
</script>
<script>
document.getElementById("matricula").addEventListener("input", function() {
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10); // Limita a 10 caracteres
    }
});
</script>
</body>
</html>