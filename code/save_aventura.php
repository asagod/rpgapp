<?php
include "connection.php";
require "validation.php";

$temp = explode(".", $_FILES["imagem"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_dir = "../img/aventura/";
$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Checar se o arquivo realmente é uma imagem
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagem"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}
// Checar se o arquivo já existe
if (file_exists($target_file)) {
    echo "Arquivo já existe.";
    $uploadOk = 0;
}
// Checar tamanho do arquivo
if ($_FILES["imagem"]["size"] > 2048000) {
    echo "O seu arquivo é muito pesado.";
    $uploadOk = 0;
}
// Permitir certos formatos
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
    $uploadOk = 0;
}
// Checar se $uploadOk foi setado para 0 por um erro
if ($uploadOk == 0) {
    echo "O seu arquivo não pode ser enviado.";
// Se tudo estiver certo, tentar fazer o upload
} else {
    //$temp = explode(".", $_FILES["imagem"]["tmp_name"]);
    //$newfilename = round(microtime(true)) . '.' . end($temp);
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
        echo "O arquivo " . basename($_FILES["imagem"]["name"]) . " foi salvo.";
    } else {
        echo "Ocorreu um erro no upload do arquivo.";
    }
}

$nome = $_POST['aventuranome'];
$mestre = $_SESSION['idLogado'];
$imagem = $newfilename;
$pontos = $_POST['pontos'];
$codigo = (substr(round(microtime(true)), 4, 4));


if ($datatreatment2 = mysqli_prepare($connection, "INSERT INTO aventura (nome,codigo,imagem,id_mestre,pontos) values(?,?,?,?,?)")) {
    mysqli_stmt_bind_param($datatreatment2, "sssii", $nome, $codigo, $imagem, $mestre, $pontos);

    if (mysqli_stmt_execute($datatreatment2)) {
        if (mysqli_stmt_affected_rows($datatreatment2) > 0) {
            header("Location:../campaign_sheet");
        } else {
            echo mysqli_error($connection);
            echo "Erro 1! Registro não gravado!";
        }
    } else {
        echo mysqli_error($connection);
    }
    mysqli_stmt_close($datatreatment2);
} else {
    echo "Erro 2! Registro não gravado!";
}
mysqli_close($connection);
