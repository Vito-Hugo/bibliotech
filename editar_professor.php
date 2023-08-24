<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Professor</title>
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
            width: 100%;
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

    // Verificar se o ID do professor foi fornecido na URL
    if (isset($_GET["id"])) {
        $professorId = $_GET["id"];

        // Recuperar os dados do professor com base no ID
        $sql = "SELECT * FROM professores WHERE id = $professorId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $professor = $result->fetch_assoc();
        } else {
            echo "Professor não encontrado.";
        }
    } else {
        echo "ID do professor não fornecido.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>
<header>
    <img src="./img/logo.png" alt="" width="200" height="50">
</header>
    <h2>Editar Professor</h2>
    <form action="atualizar_professor.php" method="post">
        <input type="hidden" name="id" value="<?php echo $professorId; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $professor['nome']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $professor['email']; ?>" required><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo $professor['cpf']; ?>" required><br>

        <label for="materia">Matéria:</label>
        <input type="text" id="materia" name="materia" value="<?php echo $professor['disciplina']; ?>"><br>

        <button type="submit" id="atualizarButton">Atualizar</button>
        <button type="button" id="cancelarButton" onclick="window.location.href='professores.php'">Cancelar</button>
    </form>
    <script>
        document.getElementById("cpf").addEventListener("input", function() {
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11); // Limita a 11 caracteres
            }
        });
    </script>
</body>
</html>
