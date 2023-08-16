<?php
session_start();
session_destroy();
header("Location: cadastro_professor.html");
exit;
?>