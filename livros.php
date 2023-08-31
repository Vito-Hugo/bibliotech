<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/e31ec1b59d.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Cadastrados</title>
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
            position: relative; /* Adicione esta linha */
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .sidebar {
            background-color: #f2f2f2;
            width: 200px;
            height: 100%;
            padding: 20px;
            box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 30px; /* Adicione esta linha para adicionar espaço acima da barra lateral */
            left: 0;
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
        .sidebar ul img {
            margin-bottom: 20px;
        }  

        .container {
            margin: 20px;
            margin-left: 240px;
            padding-top: 20px;
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
            margin-bottom: 15px;
        }

        form input[type="text"],
        form input[type="date"] {
            width: 45%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
        }

        form .input-group {
            display: flex;
            justify-content: space-between;
        }

        form button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #20C475;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-top: 0px;
            margin-bottom: 5px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: 20px;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        h2 {
            margin-left: 20px;
        }
        
        .livro-disponivel {
            color: green;
        }
        
        .livro-indisponivel {
            color: red;
        }

        .search-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .search-form input[type="text"] {
            width: 200px;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .search-form button {
            padding: 8px 16px;
            font-size: 16px;
            background-color: #20C475;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .action-icons {
            display: flex;
            align-items: center;
        }

        .action-icons button {
            padding: 4px;
            margin-right: 4px;
            font-size: 18px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #20C475;
        }

        .action-icons button:hover {
            color: #13784d;
        }

        .delete-icon {
            color: red;
        }

        .quantity-input {
            width: 50px;
            padding: 6px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 4px;
        }
    </style>
    <script>
    function confirmDelete() {
        return confirm("Tem certeza de que deseja excluir este livro?");
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <h1>Administração da Biblioteca</h1>
        <div class="user-info">
            <!-- Código de autenticação e informações do usuário omitidos para brevidade -->
            <a href="logout.php">Sair</a>
        </div>
    </header>
    <div class="sidebar">
        <div class="sidebar-content">
            <img src="./img/logo.png" alt="" width="200" height="50">
            <ul>
                <li><a href="adm.php">Empréstimo</a></li>
                <li><a href="usuarios.php">Alunos</a></li>
                <li><a href="clube_livro.php">Clube do Livro</a></li>
                <li><a href="professores.php">Professores</a></li>
                <li><a href="cadastro_livro.php">Cadastro de Livros</a></li>
                <li><a href="livros.php">Livros</a></li>
        </ul>
        </div>
    </div>

    <div class="container">
        <h2>Livros Cadastrados</h2>
        <form action="livros.php" method="GET">

        <div class="search-form">
            <input type="text" id="search" name="search" placeholder="Buscar por livro ou autor">
            <button type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>

        <table>
            <tr>
                <th>Livro</th>
                <th>Autor</th>
                <th>Classificação Indicativa</th>
                <th>Páginas</th>
                <th>Ano de Publicação</th>
                <th>Editora</th>
                <th>Idioma</th>
                <th>Posição do Livro</th>
                <th>codigo</th>
                <th>Unidade</th>
                <th>Ações</th>
            </tr>
            <?php
            // Conexão com o banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "bibliotech";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
            }

            // Verificar se foi enviada uma pesquisa
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            
                // Consulta para recuperar os livros com base na pesquisa
                $sql = "SELECT * FROM livros WHERE nome LIKE '%$search%' OR autor LIKE '%$search%'";
            } else {
                // Consulta para recuperar todos os livros
                $sql = "SELECT * FROM livros";
            }
            $result = mysqli_query($conn, $sql);

            // Loop para exibir os livros
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['autor'] . "</td>";
                echo "<td>" . $row['classificacao'] . "</td>";
                echo "<td>" . $row['paginas'] . "</td>";
                echo "<td>" . $row['ano'] . "</td>";
                echo "<td>" . $row['editora'] . "</td>";
                echo "<td>" . $row['idioma'] . "</td>";
                echo "<td>" . $row['posicao'] . "</td>";
                echo "<td>" . $row['codigo'] . "</td>";
                echo "<td>" . $row['unidade'] . "</td>";
                echo "<td>
                        <div class='action-icons'>
                        <a href='editar_livro.php?codigo=" . $row['codigo'] . "'><i class='fas fa-pencil-alt'></i></a>
                            <form action='atualizar_livro.php' method='post'>
                                <input type='hidden' name='livro_id' value='" . $row['id'] . "'>
                                <button type='submit' name='acao' value='adicionar'><i class='fas fa-plus'></i></button>
                                <input type='number' class='quantity-input' name='quantidade' value='1' min='1'>
                                <button type='submit' name='acao' value='remover'><i class='fas fa-minus'></i></button>
                            </form>
                            <form action='excluir_livro.php' method='post' onsubmit='return confirmDelete();'>
                            <input type='hidden' name='livro_id' value='" . $row['id'] . "'>
                            <button type='submit' name='acao' value='excluir' class='delete-icon'><i class='fas fa-trash'></i></button>
                        </form>

                        </div>
                      </td>";
                echo "</tr>";
            }

            // Fechando a conexão com o banco de dados
            mysqli_close($conn);
            ?>
        </table>
    </div>
    <script>
    $(document).ready(function() {
        var sidebar = $(".sidebar");
        var headerHeight = $("header").outerHeight();
        
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var sidebarTop = Math.max(headerHeight - scroll, 0);
            sidebar.css("top", sidebarTop + "px");
    });
});
</script>
</body>
</html>
