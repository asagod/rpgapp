<?php
include ("connection.php");
require ("validation.php");

$salt = "heyguyshowsitgoing";
$miner = "whathaveidone";
$kripp = sha1($salt . $miner);
$nome = $_POST['nome'];
$senha = ($salt . $miner . base64_encode($_POST['senha']) . $kripp);
if (isset($_POST['admin'])){
$admin=$_POST['admin'];    
} else{
    $admin=1;
}

if ($data = mysqli_prepare($connection, "INSERT INTO usuario (nome,senha,admin) values(?,?,?)")) {
    mysqli_stmt_bind_param($data, "sss", $nome,$senha,$admin);

    if (mysqli_stmt_execute($data)) {
        if (mysqli_stmt_affected_rows($data) > 0) {
            //$msg = urlencode("Cadastro de usuário realizado!");
            header("Location:../" . $msg);
        } else {
            echo mysqli_error($connection);
            echo "Erro! Registro não gravado!";
        }
    } else {
        echo mysqli_error($connection);
    } mysqli_stmt_close($data);
} else {
    echo "Erro! Registro não gravado!";
} mysqli_close($connection);
?>