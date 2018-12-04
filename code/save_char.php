<?php
include "connection.php";
require "validation.php";

$temp = explode(".", $_FILES["imagem"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_dir = "../img/personagem/";
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

$nome = $_POST['nome'];
$user = $_SESSION['idLogado'];
$raca = $_POST['raca'];
$classe = $_POST['classe'];
$subclasse = $_POST['subclasse'];
$sexo = $_POST['sexo'];
$idade = $_POST['idade'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$classe_social = $_POST['classe_social'];
$profissao = $_POST['profissao'];
(isset($_POST['id_aventura'])) ? $aventura = $_POST['id_aventura'] : $aventura = "000";
$valortemporario = '1';
$imagem = $newfilename;
$atributo = round(microtime(true));
$pericia = $atributo;
$_neg = 'Não';
$_pos = 'Sim';
$_1 = 'I';
$_2 = 'II';
$_3 = 'III';
$_4 = 'IV';
$_5 = 'V';

$profquery = mysqli_query($connection, "SELECT * FROM profissao WHERE id='$profissao'") or die("Problema na pesquisa");
$profcount = mysqli_num_rows($profquery);
if ($profcount == 0) {
    $msg = "Erro!";
} else {
    while ($profrow = mysqli_fetch_array($profquery)) {
        $pericia1 = $profrow['pericia1'];
        $pericia2 = $profrow['pericia2'];
        $pericia3 = $profrow['pericia3'];
    }
}

if ($sexo == 1) {
    $sexfisico = 10;
    $sexsocial = -10;
} else {
    $sexfisico = -10;
    $sexsocial = 10;
}

$idadequery = mysqli_query($connection, "SELECT * from idade WHERE id = '$idade'") or die("Problema na pesquisa");
$idadecount = mysqli_num_rows($idadequery);
if ($idadecount == 0) {
    $idaderows = 0;
} else {
    while ($idaderow = mysqli_fetch_array($idadequery)) {
        $idadefis = $idaderow['fisico'];
        $idadesoc = $idaderow['social'];
        $idademen = $idaderow['mental'];
    }
}

$racaquery = mysqli_query($connection, "SELECT * from raca WHERE id = '$raca'") or die("Problema na pesquisa");
$racacount = mysqli_num_rows($racaquery);
if ($racacount == 0) {
    $racarows = 0;
} else {
    while ($racarow = mysqli_fetch_array($racaquery)) {
        $str = floor(($racarow['fisico'] + $racarow['poder'] + $sexfisico + $idadefis) / 2);
        $dex = floor(($racarow['fisico'] + $racarow['acuidade'] + $sexfisico + $idadefis) / 2);
        $vit = floor(($racarow['fisico'] + $racarow['resistencia'] + $sexfisico + $idadefis) / 2);
        $int = floor(($racarow['mental'] + $racarow['poder'] + $idademen) / 2);
        $sab = floor(($racarow['mental'] + $racarow['acuidade'] + $idademen) / 2);
        $det = floor(($racarow['mental'] + $racarow['resistencia'] + $idademen) / 2);
        $per = floor(($racarow['social'] + $racarow['poder'] + $sexsocial + $idadesoc) / 2);
        $lab = floor(($racarow['social'] + $racarow['acuidade'] + $sexsocial + $idadesoc) / 2);
        $com = floor(($racarow['social'] + $racarow['resistencia'] + $sexsocial + $idadesoc) / 2);
    }
}

if ($datatreatment0 = mysqli_prepare($connection, "INSERT INTO pericias (id,$pericia1,$pericia2,$pericia3) values(?,?,?,?)")) {
    mysqli_stmt_bind_param($datatreatment0, "isss", $atributo, $_3, $_2, $_1);

    if (mysqli_stmt_execute($datatreatment0)) {
        if (mysqli_stmt_affected_rows($datatreatment0) > 0) {
        } else {
            echo mysqli_error($connection);
            echo "Erro 1! Raça não gravada!";
        }
    } else {
        echo mysqli_error($connection);
    }
    mysqli_stmt_close($datatreatment0);
} else {
    echo "Erro 2! Raça não gravada!";
}

if ($datatreatment1 = mysqli_prepare($connection, "INSERT INTO atributos (id,forca,destreza,vitalidade,inteligencia,sabedoria,determinacao,personalidade,labia,compostura) values(?,?,?,?,?,?,?,?,?,?)")) {
    mysqli_stmt_bind_param($datatreatment1, "iddddddddd", $pericia, $str, $dex, $vit, $int, $sab, $det, $per, $lab, $com);

    if (mysqli_stmt_execute($datatreatment1)) {
        if (mysqli_stmt_affected_rows($datatreatment1) > 0) {
        } else {
            echo mysqli_error($connection);
            echo "Erro 1! Raça não gravada!";
        }
    } else {
        echo mysqli_error($connection);
    }
    mysqli_stmt_close($datatreatment1);
} else {
    echo "Erro 2! Raça não gravada!";
}

if ($datatreatment2 = mysqli_prepare($connection, "INSERT INTO personagem (nome,id_usuario,id_raca,id_classe,id_subclasse,id_sexo,id_idade,id_altura,id_peso,id_classe_social,id_profissao,id_aventura,imagem,id_atributos,id_pericias,id_equipamento,hp,maxhp) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
    mysqli_stmt_bind_param($datatreatment2, "siiiiiiiiiiisiiidd", $nome, $user, $raca, $classe, $subclasse, $sexo, $idade, $altura, $peso, $classe_social, $profissao, $aventura, $imagem, $atributo, $pericia, $valortemporario, $vit, $vit );

    if (mysqli_stmt_execute($datatreatment2)) {
        if (mysqli_stmt_affected_rows($datatreatment2) > 0) {
            header("Location:../user");
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
