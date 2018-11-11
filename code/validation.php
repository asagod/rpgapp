<?php
session_start();
if (!isset($_SESSION['idLogado'])) {
    session_destroy();
    header("Location: code/404");
}
