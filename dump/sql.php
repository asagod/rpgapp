<?php include("code/connection.php");

$textquery = mysqli_query($connection, "SELECT * FROM informacoes") or die("Problema na pesquisa");
$textcount = mysqli_num_rows($textquery);
if ($textcount == 0) {
    $msg = "Erro!";
} else {
    $msg = "Sucesso!!!";
    $textrows = $textcount;
}

?>