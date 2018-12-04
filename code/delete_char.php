<?php
include "connection.php";
require "validation.php";
$id = $_GET['id'];

        if ($tratamento = mysqli_prepare($connection, "DELETE FROM personagem where id=?")) {
            mysqli_stmt_bind_param($tratamento, "i", $id);

            if (mysqli_stmt_execute($tratamento)) {
                if (mysqli_stmt_affected_rows($tratamento) > 0) {
                    header("Location:../admin/chars");
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
       