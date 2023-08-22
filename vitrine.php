<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="img/top.png"/>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Biblio - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>

    
</style>
<body>
    <header class="header">
        <div class="header-1">
            <a href="#" class="logo"><i class="fas fa-book"></i>Bliblio</a>
        
        <form action="busca_livro.php" class="search-form" method="GET">
    <input type="search" name="livro-nome" placeholder="Procure aqui..." id="search-box">
    <button type="submit"><i class="fas fa-search"></i></button>
</form>

        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
        
            <a href="logout.php">sair</a>
        </div>
    </div>
    <div class="header-2">
        <nav class="navbar">
            <a href="#home"></a>
            <!-- <a href="#destque">Destaque</a>
            <a href="#lancamento">Lançamentos</a>
            <a href="#comentarios">Comentarios</a>
            <a href="#contato">Contato</a> -->
        </nav>
    </div>
    </header>


    <section class="home" id="home">
        <div class="row">
            <div class="content">
                <h3>O melhor lugar para alugar seu livro</h3>
                <p>Uma biblioteca é o portal encantado onde palavras se transformam em aventuras, conhecimento ganha vida e sonhos encontram asas para voar.</p>
            
            </div> 

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href=""><img src="img/livro1.jpg" alt=""></a>
                <a href="" class="wiper-slide"><img src="img/livro2.jpg" alt=""></a>
                <a href="" class="wiper-slide"><img src="img/livro3.jpg" alt=""></a>
                <a href="" class="wiper-slide"><img src="img/livro4.jpg" alt=""></a>
                <a href="" class="wiper-slide"><img src="img/livro5.jpg" alt=""></a>
                <a href="" class="wiper-slide"><img src="img/livro6.jpg" alt=""></a>
                </div>
                
            </div>
        </div>
    </section>

    <section class="icons-container">
        <div class="icons">
            <i class="fas fa-plane"></i>
            <div class="content">
                <h3>Frete grátis</h3>
                <p>Para qualquer lugar de itajaí</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3>Segurança</h3>
                <p>Seus dados estão seguros aqui</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3>Devolução facil</h3>
                <p>10 dias de devolução</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3>Suporte</h3>
                <p>Ligue para nós qualquer hora</p>
            </div>
        </div>
    </section>
    <section class="featured" id="featured">
    <h1 class="heading"><span>Acervo</span></h1>
    <div class="swiper featured-slider">
        <div class="swiper-wrapper">
            <?php
            // Conexão com o banco de dados
            $conexao = mysqli_connect('localhost', 'root', 'root', 'bibliotech');

            // Verifica a conexão
            if (mysqli_connect_errno()) {
                echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
            }

            // Consulta SQL para recuperar os dados dos livros
            $query = "SELECT * FROM livros LIMIT 20";
            $result = mysqli_query($conexao, $query);

            // Loop para exibir os registros
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $nome = $row['nome'];
                $autor = $row['autor'];
                $imagens = $row['imagens'];
                $unidade = $row['unidade'];
                $sinopse = $row['sinopse'];
            ?>
                
                <div class="swiper-slide box" style="height: 450px; background-color: #f2f2f2;">
    <div class="icons">
        <!-- Ícones e outros elementos de interação do livro -->
    </div>
    <div class="image">
        <a href="descricao.php?id=<?php echo $id; ?>" class="book-link">
            <img src="<?php echo $imagens; ?>" alt="">
        </a>
    </div>
    <div class="content">
        <h3><?php echo $nome; ?></h3>
        <div class="autor"><?php echo $autor; ?></div>
        <!-- Outras informações do livro -->
    </div>
</div>
                
<?php
}

            // Fecha a conexão com o banco de dados
            mysqli_close($conexao);
            ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

    <section class="newsletter">
        <form action="">
        <h3>Inscreva-se para as atualizações mais recentes</h3>
        <input type="email" name="" placeholder="Digite seu email" id="" class="box">
        <input type="submit" value="Se inscrever" class="btn">

        </form>
    </section>

    <?php
// Estabeleça a conexão com o banco de dados (substitua as credenciais conforme necessário)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bibliotech";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta SQL para recuperar os dados dos livros
$sql = "SELECT * FROM livros";
$result = $conn->query($sql);
?>

<section class="arrivals" id="arrivals">
    <h1 class="heading"><span>Recém-chegados</span></h1>
    <div class="swiper arrivals-slider">
        <div class="swiper-wrapper">
            <?php
            // Verifique se há resultados da consulta
            if ($result->num_rows > 0) {
                // Loop através dos resultados e exiba as informações dos livros
                while ($row = $result->fetch_assoc()) {
                    $nome = $row["nome"];
                    $autor = $row["autor"];
                    $imagens = $row["imagens"];
                    $unidade = $row["unidade"];
                    $sinopse = $row['sinopse'];
            ?>
                    <a href="#" class="swiper-slide box">
                        <div class="image">
                            <img src="img/<?php echo $imagens; ?>" alt="">
                        </div>
                        <div class="content">
                            <h3><?php echo $nome; ?></h3>
                            <div class="autor"><?php echo $autor; ?></div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </a>

            <?php
                }
            } else {
                echo "Nenhum livro encontrado.";
            }
            // Feche a conexão com o banco de dados
            $conn->close(); 
            ?>
        </div>

    </div>
    
</section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <div id="sinopse-modal" class="modal">
    <div class="modal-content">
        <span id="close-modal-btn" class="close-modal-btn">&times;</span>
        <div id="sinopse-modal-content"></div>
    </div>
</div>

<script>
    const sinopseButtons = document.querySelectorAll('.fa-eye');
    const sinopseModal = document.getElementById('sinopse-modal');
    const sinopseModalContent = document.getElementById('sinopse-modal-content');
    const closeModalBtn = document.getElementById('close-modal-btn');

    function showSinopse(event) {
        const sinopse = event.target.parentElement.parentElement.querySelector('.sinopse').textContent;
        sinopseModalContent.textContent = sinopse;
        sinopseModal.style.display = 'block';
    }

    sinopseButtons.forEach(button => {
        button.addEventListener('click', showSinopse);
    });

    closeModalBtn.addEventListener('click', () => {
        sinopseModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === sinopseModal) {
            sinopseModal.style.display = 'none';
        }
    });
</script>
    <script src="js/script.js"></script>
    
</body>
</html>