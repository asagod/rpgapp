<?php
include "connection.php";
require "validation.php";

$key = base64_encode($_GET['id']);
$id = $_GET['id'];
$nivel = $_GET['nivel'];
$newlevel = ($nivel+1);
$pontos = (10+$newlevel);


if ($datatreatment = mysqli_prepare($connection, "UPDATE personagem SET id_nivel=?, maxpontos=? WHERE id=?")) {
    mysqli_stmt_bind_param($datatreatment, "sdi", $newlevel, $pontos, $id);

    if (mysqli_stmt_execute($datatreatment)) {
        if (mysqli_stmt_affected_rows($datatreatment) > 0) {
            $msg = urlencode("Personagem atualizado!");
            header("Location:../character_sheet?key=" . $key);
        } else {
            echo mysqli_error($connection);
            $msg = urlencode("Não houve mudança no personagem!");
            header("Location:../character_sheet?key=" . $key);
        }
    } else {
        echo mysqli_error($connection);
    } mysqli_stmt_close($datatreatment);
} else {
    echo "Erro 2!";
} mysqli_close($connection);