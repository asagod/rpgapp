<?php
include "connection.php";
require "validation.php";

$id = base64_encode($_POST['id']);
$str = $_POST['forca'];
$dex = $_POST['destreza'];
$vit = $_POST['vitalidade'];
$int = $_POST['inteligencia'];
$sab = $_POST['sabedoria'];
$det = $_POST['determinacao'];
$per = $_POST['personalidade'];
$lab = $_POST['labia'];
$com = $_POST['compostura'];
$atributo = $_POST['atributo'];

if ($datatreatment = mysqli_prepare($connection, "UPDATE atributos SET forca=?, destreza=?, vitalidade=?, inteligencia=?, sabedoria=?, determinacao=?, personalidade=?, labia=?, compostura=? WHERE id=?")) {
    mysqli_stmt_bind_param($datatreatment, "dddddddddi", $str, $dex, $vit, $int, $sab, $det, $per, $lab, $com, $atributo);

    if (mysqli_stmt_execute($datatreatment)) {
        if (mysqli_stmt_affected_rows($datatreatment) > 0) {
            $msg = urlencode("Cadastro atualizado para admin!");
            header("Location:../character_sheet?key=" . $id . "#atributos");
        } else {
            echo mysqli_error($connection);
            $msg = urlencode("Não houve mudança no cadastro!");
            header("Location:../character_sheet?key=" . $id . "#atributos");
        }
    } else {
        echo mysqli_error($connection);
    } mysqli_stmt_close($datatreatment);
} else {
    echo "Erro 2!";
} mysqli_close($connection);