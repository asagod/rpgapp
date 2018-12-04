<?php
session_start();
if (!isset($_SESSION['idLogado'])) {
    session_destroy();
    header("Location: code/404");
} else if ($_SESSION['adminUsuario'] == 3){
    header("Location: banned");
}

