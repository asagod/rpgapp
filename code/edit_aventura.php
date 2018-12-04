<?php
include "connection.php";
require "validation.php";

$id = $_POST['charid'];
$cod = $_POST['aventura'];

$aventuraquery = mysqli_query($connection, "SELECT *  FROM aventura WHERE codigo = '$cod'") or die("Problema na pesquisa");
$aventuracount = mysqli_num_rows($aventuraquery);
if ($aventuracount == 0) {
    $msg = "Esta aventura não existe";
} else {
    while ($aventurarow = mysqli_fetch_array($aventuraquery)) {
        $aventuraid = $aventurarow["id"];

        if ($datatreatment = mysqli_prepare($connection, "UPDATE personagem SET id_aventura=? WHERE id=?")) {
            mysqli_stmt_bind_param($datatreatment, "ii", $aventuraid, $id);
        
            if (mysqli_stmt_execute($datatreatment)) {
                if (mysqli_stmt_affected_rows($datatreatment) > 0) {
                    $msg = urlencode("Personagem atualizado!");
                    header("Location:../character_sheet?key=" . $id);
                } else {
                    echo mysqli_error($connection);
                    $msg = urlencode("Não houve mudança no personagem!");
                    header("Location:../character_sheet?key=" . (base64_encode($id)));
                }
            } else {
                echo mysqli_error($connection);
            } mysqli_stmt_close($datatreatment);
        } else {
            echo "Erro 2!";
        }
    }
}  mysqli_close($connection);
