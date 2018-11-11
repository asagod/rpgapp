<?php
include "connection.php";
$salt = "heyguyshowsitgoing";
$miner = "whathaveidone";
$kripp = sha1($salt . $miner);

if (isset($_POST['nome']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $senha = ($salt . $miner . base64_encode($_POST['senha']) . $kripp);

    if ($connection) {
        if ($data = mysqli_prepare(
            $connection,
            "SELECT * from  usuario  where  nome=? and senha=? limit 1"
        )) {
            mysqli_stmt_bind_param($data, "ss", $nome, $senha);

            mysqli_stmt_execute($data);

            mysqli_stmt_bind_result($data, $id, $nome, $senha, $admin);

            mysqli_stmt_store_result($data);

            if (mysqli_stmt_num_rows($data) > 0) {
                mysqli_stmt_fetch($data);
                session_start();
                $_SESSION['idLogado'] = $id;
                $_SESSION['nomeLogado'] = $nome;
                $_SESSION['senhaLogado'] = $senha;
                $_SESSION['adminUsuario'] = $admin;
                if ($admin == "1") {
                    header("Location: ../admin");
                } else {
                    header("Location:../user");
                }

            } else {
                header("Location: ../?erro=nao_existe");
            }
            mysqli_stmt_close($data);
        } else {
            header("Location: ../?erro=conexao");
        }
        mysqli_close($connection);
    }
} else {
    header("Location: ../?erro=form");
}
