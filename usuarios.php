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

        .container {
            margin: 20px;
            overflow: hidden;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-left: 20px;
        }

        h2{
            margin-left: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #20C475;
            color: #fff;
        }

        .edit-icon, .delete-icon {
            color: #20C475;
            cursor: pointer;
            margin-right: 10px;
        }
        .delete-icon{
            color: red;
        }

        .edit-icon{
            color: black;
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
        .white-bg {
    border-radius: 50%; /* Isso pode ajudar a criar um fundo circular para os ícones */
    padding: 5px; /* Pode ajustar o espaçamento em torno dos ícones */
    color: #FF0000; /* Mantém a cor do ícone */
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
            <li><a href="adm.php">Emprestimo</a></li>
            <li><a href="usuarios.php">Alunos</a></li>
            <li><a href="clube_livro.php">Clube do Livro</a></li>
            <li><a href="clube_livro.php">Projeto de Leitura</a></li>
            <li><a href="professores.php">Professores</a></li>
            <li><a href="cadastro_livro.php">Cadastro de Livros</a></li>
            <li><a href="livros.php">Livros</a></li>
        </ul>
    </div>
    <div class="container">
        <h2>Lista de Alunos</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Matricula</th>
                        <th>Ano</th>
                        <th>Historico</th>
                        <th>Edição</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Consulta SQL para recuperar os professores cadastrados
                    $sql = "SELECT * FROM usuarios";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["nome"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["matricula"] . "</td>";
                            echo "<td>" . $row["turma"] . "</td>";
                            echo "<td>"; // Coluna de Histórico
                        
                            // Aqui você pode exibir o histórico, por exemplo:
                            echo "<p>Historico</p>"; // Substitua isso pelo conteúdo do histórico
                        
                            echo "</td>";
                            echo "<td>"; // Coluna de Edição e Exclusão
                            echo "<span class='edit-icon' title='Editar' onclick='editarProfessor(" . $row["id"] . ")'>&#9998;</span>";
                            echo "<span class='delete-icon white-bg' title='Excluir' onclick='excluirProfessor(" . $row["id"] . ")'>&#128465;</span>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum professor cadastrado.</td></tr>";
                    }

                    // Fechar a conexão com o banco de dados
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function editarProfessor(id) {
        // Redirecionar para a página de edição do professor com o ID fornecido
        window.location.href = "editar_professor.php?id=" + id;
    }

    function excluirProfessor(id) {
        // Exibir uma confirmação de exclusão usando a função confirm do JavaScript
        if (confirm("Deseja realmente excluir este professor?")) {
            // Implemente a lógica para excluir o professor com o ID fornecido
            // Por exemplo, você pode enviar uma solicitação AJAX para um arquivo PHP que executa a exclusão no banco de dados
            // Após a exclusão, você pode atualizar a página ou realizar outras ações necessárias

            // Exemplo de código AJAX para excluir o professor usando jQuery
            $.ajax({
                url: "excluir_professor.php",
                type: "POST",
                data: { id: id },
                success: function (response) {
                    // Ação bem-sucedida após a exclusão (por exemplo, atualizar a tabela de professores)
                    // Você pode realizar qualquer ação necessária aqui
                    // Por exemplo, atualizar a tabela de professores ou redirecionar para uma página específica
                },
                error: function (xhr, status, error) {
                    // Lidar com erros na exclusão do professor (por exemplo, exibir uma mensagem de erro)
                    // Você pode realizar qualquer ação necessária aqui
                }
            });
        }
    }
</script>

</body>
</html>