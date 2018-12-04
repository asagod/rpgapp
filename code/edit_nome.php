<?php
include "connection.php";
require "validation.php";

$key = base64_encode($_POST['charid']);
$id = $_POST['charid'];
$newname = $_POST['nome'];


if ($datatreatment = mysqli_prepare($connection, "UPDATE personagem SET nome=? WHERE id=?")) {
    mysqli_stmt_bind_param($datatreatment, "si", $newname, $id);

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