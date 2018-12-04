<?php
include "connection.php";
require "validation.php";
$newowner = $_POST['newowner'];
$newcharid = $_POST['newcharid'];

        if ($tratamento = mysqli_prepare($connection, "UPDATE personagem SET id_usuario=? where id=?")) {
            mysqli_stmt_bind_param($tratamento, "ii", $newowner, $newcharid);

            if (mysqli_stmt_execute($tratamento)) {
                if (mysqli_stmt_affected_rows($tratamento) > 0) {
                    header("Location:../admin/users");
                } else {
                    echo mysqli_error($connection);
                    echo "Erro!";
                }
            } else {
                echo mysqli_error($connection);
            } mysqli_stmt_close($tratamento);
        } else {
            echo "Erro!";
        } mysqli_close($connection);
        ?>