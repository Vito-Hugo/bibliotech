<?php
if (isset($_GET['id'])) {
    $professorId = $_GET['id'];
    // Aqui você pode incluir o formulário de edição do professor com os campos pré-preenchidos com os dados do professor a ser editado.
} else {
    echo "ID do professor não fornecido.";
}
?>
