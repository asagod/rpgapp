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




pericias.id AS pericia, atributos.id AS id, atributos.forca AS forca, atributos.destreza AS destreza, atributos.vitalidade AS vitalidade, atributos.inteligencia AS inteligencia, atributos.sabedoria AS sabedoria, atributos.determinacao AS determinacao, atributos.personalidade AS personalidade, atributos.labia AS labia, atributos.compostura AS compostura