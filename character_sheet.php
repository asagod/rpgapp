<!DOCTYPE html>
<html lang="en">
    <?php
    if (isset($_GET['key'])) {
        $charid = (base64_decode($_GET['key']));
    } else {
        header("Location: user");
    }
    ?>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Cainã Strücker">
        <!-- <meta http-equiv="refresh" content="5"> -->

        <title>S.C.A.R.</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Plugin CSS -->
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

        <!-- Custom styles for this template -->
        <link href="css/freelancer.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/bootstrap-imageupload.css" rel="stylesheet">

    </head>

    <body id="page-top">
        <?php
        include "code/connection.php";
        include "code/functions.php";
        require "code/validation.php";
        ?>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../RPGApp">Página Inicial</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse"
                        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="inbox">Mensagens</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="user">Perfil</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <hr class="star-dark mb-5">

        <!-- Sheet Section -->
        <div class="container">
            <div class="row">
                <section>
                    <div class="col-lg-12">
                        <?php
                        if (isset($_SESSION['idLogado'])) {
                            $userId = $_SESSION['idLogado'];
                        }
                        $query = mysqli_query($connection, "SELECT personagem.id AS charid, personagem.id_usuario AS userid, aventura.id_mestre AS mestre, personagem.nome AS charnome, personagem.id_atributos AS charatributos, personagem.maxhp AS maxhp, personagem.hp AS hp, personagem.pontos AS pontos, personagem.maxpontos AS maxpontos, personagem.exaustao AS exaustao, personagem.ferimentos AS ferimentos, personagem.imagem AS imagem, personagem.id_nivel AS charnivel, raca.nome AS charsubclasse, subclasse.nome AS charraca FROM personagem INNER JOIN subclasse ON personagem.id_subclasse = subclasse.id INNER JOIN raca ON personagem.id_raca = raca.id INNER JOIN aventura ON aventura.id = personagem.id_aventura WHERE personagem.id = '$charid'") or die("Problema na pesquisa");
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            printf("<header><strong>Este produto não foi encontrado!</strong></header>");
                        } else {
                            while ($row = mysqli_fetch_array($query)) {
                                if ($userId != $row['userid']) {
                                    if ($row['mestre'] != $userId) {
                                        header("Location: code/404");
                                    } else {
                                    }
                                } else {
                                }
                                ?>

                                <div class="card">
                                    <img class="card-img-top img-fluid img-sheet" src="img/personagem/<?php echo $row['imagem'] ?>" alt="Imagem do personagem">
                                    <div class="card-body">
                                    <form action="code/edit_char.php" method="POST">
                                        <h3 class="card-title"><?php echo $row['charnome'] ?>, <?php echo $row['charsubclasse'] ?> <?php echo $row['charraca']; ?> (Nível <?php echo $row['charnivel']; ?>)</h3>
                                        <hr>
                                        <div class="form-inline">
                                        <div class="input-group mb-3 col-xs-12 col-md-6 lados">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Pontos de Vida</span>
                                            </div>
                                            <input type="text" class="form-control" name="hp" id="hp" placeholder="HP" aria-label="HP" aria-describedby="hp-max" value="<?php echo $row['hp'] ?>" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="hp-max"><?php echo $row['maxhp']; ?></span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3 col-xs-12 col-md-6 lados">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Pontos de Classe</span>
                                            </div>
                                            <input type="text" class="form-control" name="pontos" id="pontos" placeholder="Pontos" aria-label="Pontos" aria-describedby="pontos-max" value="<?php echo $row['pontos'] ?>" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="pontos-max"><?php echo $row['pontos']; ?></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-inline">
                                        <div class="input-group mb-3 col-xs-12 col-md-6 lados">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Ferimentos</span>
                                            </div>
                                            <input type="number" class="form-control" name="ferimentos" id="ferimentos" placeholder="Ferimentos" aria-label="Ferimentos" aria-describedby="feimentos-max" value="<?php echo $row['ferimentos'] ?>" min="0" max="3" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="ferimentos-max">3</span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3 col-xs-12 col-md-6 lados">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Exaustão</span>
                                            </div>
                                            <input type="text" class="form-control" name="exaustao" id="exaustao" placeholder="Exaustão" aria-label="Exaustão" aria-describedby="exaustao-max" value="<?php echo $row['exaustao'] ?>" min="0" max="10" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="exaustao-max">10</span>
                                            </div>
                                        </div>
                                        </div>
                                        <hr>
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-secondary"  id="editar-main">Editar</button>
                                        <input type="hidden" name="charid" value="<?php echo $row['charid'] ?>">
                                        <input type="submit" class="submit_on_enter" hidden>
                                        </form>
    
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-redo" aria-hidden="true"></i><span class="caret"></span>
                                            </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Pontos de Vida</a></li>
                                                    <li><a href="#">Pontos de Classe</a></li>
                                                    <li><a href="#">Exaustão</a></li>
                                                    <li><a href="#">Ferimentos</a></li>
                                                    <li><a href="#">Todos</a></li>
                                                </ul>
  	                                    </div>
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                             <i class="fa fa-cog" aria-hidden="true"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="code/lvl_up.php?<?php echo 'id=' . urlencode($charid) . '&nivel=' . urlencode($row['charnivel']) ?>" onclick="return confirm('Tem certeza que deseja aumentar o nível do personagem?')">Subir de Nível</a></li>
                                                <li><a href="#modal-nome" data-toggle="modal">Editar Nome</a></li>
                                                <li><a href="#modal-aventura" data-toggle="modal">Editar Aventura</a></li>
                                                <li class="divider"><hr></li>
                                                <li><a href="code/remove_char.php?id=<?php echo $charid ?>" onclick="return confirm('Tem certeza que deseja remover este personagem da aventura atual?')">Remover da Aventura</a></li>
                                                <li><a href="code/disable_char.php?id=<?php echo $charid ?>" onclick="return confirm('Tem certeza que deseja excluir este personagem?')">Excluir Personagem</a></li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL NOME -->
                                <div class="modal" tabindex="-1" role="dialog" id="modal-nome">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="code/edit_nome" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Personagem</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group form-inline">
                                                        <label for="nome" class="col-xs-4 col-md-4 col-form-label mb-1">Novo Nome:</label>
                                                        <input type="text" class="form-control mb-3 col-xs-12 col-md-7" id="nome" name="nome">
                                                    </div>
                                                    <input type="hidden" class="form-control" id="charid" name="charid" value="<?php echo $charid ?>">
                                                    <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $userId ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL -->
                                <!-- MODAL AVENTURA -->
                                <div class="modal" tabindex="-1" role="dialog" id="modal-aventura">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="code/edit_aventura" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Personagem</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group form-inline">
                                                        <label for="aventura" class="col-xs-4 col-md-4 col-form-label mb-1">Digite o código da aventura:</label>
                                                        <input type="text" class="form-control mb-3 col-xs-12 col-md-7" id="aventura" name="aventura">
                                                    </div>
                                                    <input type="hidden" class="form-control" id="charid" name="charid" value="<?php echo $charid ?>">
                                                    <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $userId ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL -->
                                <?php
                            }
                        }
                        ?>
                        <!-- /.card -->
                        <section class="portfolio" id="atributos">
                            <div class="card card-outline-secondary my-4">
                                <div class="card-header">
                                    Atributos
                                </div>
                                <div class="card-body">
                                    <?php
                                    $query2 = mysqli_query($connection, "SELECT atributos.id AS id, atributos.forca AS forca, atributos.destreza AS destreza, atributos.vitalidade AS vitalidade, atributos.inteligencia AS inteligencia, atributos.sabedoria AS sabedoria, atributos.determinacao AS determinacao, atributos.personalidade AS personalidade, atributos.labia AS labia, atributos.compostura AS compostura FROM atributos "
                                            . "INNER JOIN personagem ON personagem.id_atributos = atributos.id WHERE personagem.id = '$charid' LIMIT 1") or die("Problema na pesquisa");
                                    $count2 = mysqli_num_rows($query2);
                                    if ($count2 == 0) {
                                        printf("<header><strong>Nenhum resultado encontrado!</strong></header><hr>");
                                    } else {
                                        while ($row = mysqli_fetch_array($query2)) {
                                            ?>
                                            <form action="code/edit_atributos" method="POST">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Força</span>
                                                    </div>
                                                    <input type="text" class="form-control col-xs-6 col-md-2" name="forca" id="forca" placeholder="Força" aria-label="Força" aria-describedby="forca-mod" value="<?php echo $row['forca'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="forca-mod"><?php echo modCalc($row['forca']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Destreza</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="destreza" id="destreza" placeholder="Destreza" aria-label="Destreza" aria-describedby="destreza-mod" value="<?php echo $row['destreza'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="forca-mod"><?php echo modCalc($row['destreza']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Vitalidade</span>
                                                    </div>
                                                    <input type="text" class="form-control col-xs-6 col-md-2" name="vitalidade" id="vitalidade" placeholder="Vitalidade" aria-label="Vitalidade" aria-describedby="vitalidade-mod" value="<?php echo $row['vitalidade'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="vitalidade-mod"><?php echo modCalc($row['vitalidade']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Inteligência</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="inteligencia" id="inteligencia" placeholder="Inteligência" aria-label="Inteligência" aria-describedby="inteligencia-mod" value="<?php echo $row['inteligencia'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="inteligencia-mod"><?php echo modCalc($row['inteligencia']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Sabedoria</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="sabedoria" id="sabedoria" placeholder="Sabedoria" aria-label="Sabedoria" aria-describedby="sabedoria-mod" value="<?php echo $row['sabedoria'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="sabedoria-mod"><?php echo modCalc($row['sabedoria']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Determinação</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="determinacao" id="determinacao" placeholder="Determinação" aria-label="Determinação" aria-describedby="determinacao-mod" value="<?php echo $row['determinacao'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="determinacao-mod"><?php echo modCalc($row['determinacao']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Personalidade</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="personalidade" id="personalidade" placeholder="Personalidade" aria-label="Personalidade" aria-describedby="personalidade-mod" value="<?php echo $row['personalidade'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="personalidade-mod"><?php echo modCalc($row['personalidade']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Lábia</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="labia" id="labia" placeholder="Lábia" aria-label="Lábia" aria-describedby="labia-mod" value="<?php echo $row['labia'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="labia-mod"><?php echo modCalc($row['labia']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text atributos">Compostura</span>
                                                    </div>
                                                    <input type="number" class="form-control  col-xs-6 col-md-2" name="compostura" id="compostura" placeholder="Compostura" aria-label="Compostura" aria-describedby="compostura-mod" value="<?php echo $row['compostura'] ?>" min="1" max="100" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text mod" id="compostura-mod"><?php echo modCalc($row['compostura']); ?></span>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="atributo" id="atributo" value="<?php echo $row['id'] ?>">
                                                <input type="hidden" name="id" id="id" value="<?php echo $charid ?>">
                                                <hr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <button type="button" class="btn btn-secondary" id="editar">Editar</button>
                                        <input type="submit" class="submit_on_enter" hidden>
                                    </form>
                                </div>
                        </section>
                        <!-- /.card -->
                        <section class="portfolio" id="pericias">
                                <?php
                                $query3 = mysqli_query($connection, "SELECT pericias.id AS pericia, atributos.id AS atributo, pericias.corrida AS corrida, pericias.escalada AS escalada, pericias.montaria AS montaria, pericias.natacao AS natacao, pericias.arrombamento AS arrombamento, "
                                . "pericias.cadeados AS cadeados, pericias.armadilhas AS armadilhas, pericias.esconder AS esconder, pericias.esgueirar AS esgueirar, pericias.equilibrio AS equilibrio, pericias.roubar AS roubar, pericias.truque AS truque, pericias.objetos AS objetos, "
                                . "pericias.arcano AS arcano, pericias.historico AS historico, pericias.linguistico AS linguistico, pericias.medico AS medico, pericias.c_natural AS c_natural, pericias.religioso AS religioso, pericias.identificacao AS identificacao, pericias.investigacao AS investigacao, "
                                . "pericias.intuicao AS intuicao, pericias.percepcao AS percepcao, pericias.rastreamento AS rastreamento, pericias.sobrevivencia AS sobrevivencia, pericias.lideranca AS lideranca, pericias.diplomacia AS diplomacia, pericias.inspiracao AS inspiracao, pericias.intimidacao AS intimidacao, "
                                . "pericias.persuasao AS persuasao, pericias.adestramento AS adestramento, pericias.atuacao AS atuacao, pericias.blefe AS blefe, pericias.disfarce AS disfarce, pericias.enganacao AS enganacao, "
                                . "atributos.id AS id, atributos.forca AS forca, atributos.destreza AS destreza, atributos.vitalidade AS vitalidade, atributos.inteligencia AS inteligencia, atributos.sabedoria AS sabedoria, atributos.determinacao AS determinacao, atributos.personalidade AS personalidade, atributos.labia AS labia, atributos.compostura AS compostura FROM pericias "
                                . "INNER JOIN personagem ON personagem.id_pericias = pericias.id INNER JOIN atributos ON atributos.id = personagem.id_atributos WHERE personagem.id = '$charid' LIMIT 1") or die("Problema na pesquisa");
                                $count3 = mysqli_num_rows($query3);
                                if ($count3 == 0) {
                                    printf("<header><strong>Nenhum resultado encontrado!</strong></header><hr>");
                                } else {
                                    while ($row = mysqli_fetch_array($query3)) {
                                        ?>
                                        <form action="code/edit_atributos" method="POST">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Perícia</th>
                                                        <th scope="col">Proficiência</th>
                                                        <th scope="col">Modificador</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Corrida</th>
                                                        <td><?php echo $row['corrida'] ?></td>
                                                        <td><?php echo modCalc($row['forca']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Escalada</th>
                                                        <td><?php echo $row['escalada'] ?></td>
                                                        <td><?php echo modCalc($row['forca']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Montaria</th>
                                                        <td><?php echo $row['montaria'] ?></td>
                                                        <td><?php echo modCalc($row['forca']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Natação</th>
                                                        <td><?php echo $row['natacao'] ?></td>
                                                        <td><?php echo modCalc($row['forca']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Arrombamento</th>
                                                        <td><?php echo $row['arrombamento'] ?></td>
                                                        <td><?php echo modCalc($row['forca']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Abrir Cadeados</th>
                                                        <td><?php echo $row['cadeados'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Desarmar Armadilhas</th>
                                                        <td><?php echo $row['armadilhas'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Esconder-se</th>
                                                        <td><?php echo $row['esconder'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Esgueirar-se</th>
                                                        <td><?php echo $row['esgueirar'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Equilíbrio</th>
                                                        <td><?php echo $row['equilibrio'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Roubar</th>
                                                        <td><?php echo $row['roubar'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Truque de Mãos</th>
                                                        <td><?php echo $row['truque'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Usar Objeto</th>
                                                        <td><?php echo $row['objetos'] ?></td>
                                                        <td><?php echo modCalc($row['destreza']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Arcano</th>
                                                        <td><?php echo $row['arcano'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Histórico</th>
                                                        <td><?php echo $row['historico'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Linguístico</th>
                                                        <td><?php echo $row['linguistico'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Médico</th>
                                                        <td><?php echo $row['medico'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Natural</th>
                                                        <td><?php echo $row['c_natural'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Religioso</th>
                                                        <td><?php echo $row['religioso'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Identificação</th>
                                                        <td><?php echo $row['identificacao'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Investigação</th>
                                                        <td><?php echo $row['investigacao'] ?></td>
                                                        <td><?php echo modCalc($row['inteligencia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Intuição</th>
                                                        <td><?php echo $row['intuicao'] ?></td>
                                                        <td><?php echo modCalc($row['sabedoria']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Percepção</th>
                                                        <td><?php echo $row['percepcao'] ?></td>
                                                        <td><?php echo modCalc($row['sabedoria']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Rastreamento</th>
                                                        <td><?php echo $row['rastreamento'] ?></td>
                                                        <td><?php echo modCalc($row['sabedoria']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Sobrevivência</th>
                                                        <td><?php echo $row['sobrevivencia'] ?></td>
                                                        <td><?php echo modCalc($row['sabedoria']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Liderança</th>
                                                        <td><?php echo $row['lideranca'] ?></td>
                                                        <td><?php echo modCalc($row['personalidade']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Diplomacia</th>
                                                        <td><?php echo $row['diplomacia'] ?></td>
                                                        <td><?php echo modCalc($row['personalidade']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Inspiração</th>
                                                        <td><?php echo $row['inspiracao'] ?></td>
                                                        <td><?php echo modCalc($row['personalidade']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Intimidação</th>
                                                        <td><?php echo $row['intimidacao'] ?></td>
                                                        <td><?php echo modCalc($row['personalidade']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Persuasão</th>
                                                        <td><?php echo $row['persuasao'] ?></td>
                                                        <td><?php echo modCalc($row['personalidade']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Adestramento</th>
                                                        <td><?php echo $row['adestramento'] ?></td>
                                                        <td><?php echo modCalc($row['labia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Atuação</th>
                                                        <td><?php echo $row['atuacao'] ?></td>
                                                        <td><?php echo modCalc($row['labia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Blefe</th>
                                                        <td><?php echo $row['blefe'] ?></td>
                                                        <td><?php echo modCalc($row['labia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Disfarce</th>
                                                        <td><?php echo $row['disfarce'] ?></td>
                                                        <td><?php echo modCalc($row['labia']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Enganação</th>
                                                        <td><?php echo $row['enganacao'] ?></td>
                                                        <td><?php echo modCalc($row['labia']); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>

                                            <input type="hidden" name="atributo" id="atributo" value="<?php echo $row['id'] ?>">
                                            <input type="hidden" name="id" id="id" value="<?php echo $charid ?>">
                                            <hr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <button type="button" class="btn btn-secondary" id="editar2">Editar</button>
                                    <input type="submit" class="submit_on_enter" hidden>
                                </form>
                                <?php
                                mysqli_close($connection);
                                ?>
                        </section>



                    </div>
                </section>
            </div>
        </div>


        <!-- Footer -->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Criado por</h4>
                        <p class="lead mb-0">Cainã Strücker
                            <br>Panambi, Rio Grande do Sul</p>
                    </div>
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Redes Sociais</h4>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://facebook.com/caina.b.strucker">
                                    <i class="fab fa-fw fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://plus.google.com/105234352183121024590">
                                    <i class="fab fa-fw fa-google-plus-g"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/Asagod666">
                                    <i class="fab fa-fw fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.linkedin.com/in/cainã-strücker-6702a716a/">
                                    <i class="fab fa-fw fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-uppercase mb-4">Contato</h4>
                        <p class="lead mb-0">caina.strucker@gmail.com</p>
                        <p class="lead mb-0">contato@scar.com</p>
                    </div>
                </div>
            </div>
        </footer>

        <div class="copyright py-4 text-center text-white">
            <div class="container">
                <small>Copyright &copy; S.C.A.R. 2018</small>
            </div>
        </div>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-to-top d-lg-nRaca position-fixed ">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Contact Form JavaScript -->
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/contact_me.js"></script>

        <!-- Custom scripts for this template -->
        <script src="js/freelancer.min.js"></script>

        <script src="js/bootstrap-imageupload.js"></script>

        <script>
                    const itemForca = document.getElementById("forca")
                    const itemDestreza = document.getElementById('destreza')
                    const itemVitalidade = document.getElementById('vitalidade')
                    const itemInteligencia = document.getElementById('inteligencia')
                    const itemSabedoria = document.getElementById('sabedoria')
                    const itemDeterminacao = document.getElementById('determinacao')
                    const itemPersonalidade = document.getElementById('personalidade')
                    const itemLabia = document.getElementById('labia')
                    const itemCompostura = document.getElementById('compostura')

                    document.getElementById("editar").addEventListener('click',(e)=>{

                    itemForca.removeAttribute("disabled")
                    itemDestreza.removeAttribute("disabled")
                    itemVitalidade.removeAttribute("disabled")
                    itemInteligencia.removeAttribute("disabled")
                    itemSabedoria.removeAttribute("disabled")
                    itemDeterminacao.removeAttribute("disabled")
                    itemPersonalidade.removeAttribute("disabled")
                    itemLabia.removeAttribute("disabled")
                    itemCompostura.removeAttribute("disabled")
            })

                    const itemHP = document.getElementById("hp")
                    const itemMaxHP = document.getElementById('hp-max')
                    const itemPontos = document.getElementById('pontos')
                    const itemExaustao = document.getElementById('exaustao')
                    const itemFerimentos = document.getElementById('ferimentos')

                    document.getElementById("editar-main").addEventListener('click',(e)=>{

                    itemHP.removeAttribute("disabled")
                    itemMaxHP.removeAttribute("disabled")
                    itemPontos.removeAttribute("disabled")
                    itemExaustao.removeAttribute("disabled")
                    itemFerimentos.removeAttribute("disabled")
            })


                    //a

                    $(document).ready(function() {

            $('.submit_on_enter').keydown(function(event) {
            // enter has keyCode = 13, change it if you want to use another button
            if (event.keyCode == 13) {
            this.form.submit();
            return false;
            }
            });
            });
            //b
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();
            $('#imageupload-disable').on('click', function() {
            $imageupload.imageupload('disable');
            $(this).blur();
            })

                    $('#imageupload-enable').on('click', function() {
            $imageupload.imageupload('enable');
            $(this).blur();
            })

                    $('#imageupload-reset').on('click', function() {
            $imageupload.imageupload('reset');
            $(this).blur();
            });
            $(':radio').each(function(){
            if ($(this).is(':disabled')) {
            $(this).checked = false;
            }
            });
        </script>

    </body>

</html>