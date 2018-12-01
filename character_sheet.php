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
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="user">Voltar</a>
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
                        $query = mysqli_query($connection, "SELECT personagem.id AS charid, personagem.nome AS charnome, personagem.id_atributos AS charatributos, personagem.maxhp AS maxhp, personagem.hp AS hp, personagem.exaustao AS exaustao, personagem.ferimentos AS ferimentos, personagem.imagem AS imagem, personagem.id_nivel AS charnivel, raca.nome AS charsubclasse, subclasse.nome AS charraca FROM personagem INNER JOIN subclasse ON personagem.id_subclasse = subclasse.id INNER JOIN raca ON personagem.id_raca = raca.id WHERE personagem.id = '$charid'") or die("Problema na pesquisa");
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            printf("<header><strong>Este produto não foi encontrado!</strong></header>");
                        } else {
                            while ($row = mysqli_fetch_array($query)) {
                                ?>

                                <div class="card">
                                    <img class="card-img-top img-fluid img-sheet" src="img/personagem/<?php echo $row['imagem'] ?>" alt="Imagem do personagem">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $row['charnome'] ?>, <?php echo $row['charsubclasse'] ?> <?php echo $row['charraca']; ?> (Nível <?php echo $row['charnivel']; ?> )</h3>
                                        <hr>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Pontos de Vida</span>
                                            </div>
                                            <input type="text" class="form-control col-xs-6 col-md-2" name="forca" id="forca" placeholder="Força" aria-label="Força" aria-describedby="forca-mod" value="<?php echo $row['hp'] ?>" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="forca-mod"><?php echo $row['maxhp']; ?></span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Ferimentos</span>
                                            </div>
                                            <input type="number" class="form-control  col-xs-6 col-md-2" name="destreza" id="destreza" placeholder="Destreza" aria-label="Destreza" aria-describedby="destreza-mod" value="<?php echo $row['ferimentos'] ?>" min="0" max="3" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="forca-mod">3</span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text atributos">Exaustão</span>
                                            </div>
                                            <input type="text" class="form-control col-xs-6 col-md-2" name="vitalidade" id="vitalidade" placeholder="Vitalidade" aria-label="Vitalidade" aria-describedby="vitalidade-mod" value="<?php echo $row['exaustao'] ?>" min="0" max="10" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text mod" id="vitalidade-mod">10</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="button" data-target="#editar-modal" data-toggle="modal" class="btn btn-secondary">Editar</button>
                                    </div>
                                </div>
                                <!-- MODAL -->
                                <div class="modal" tabindex="-1" role="dialog" id="editar-modal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="edit_atributo" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Personagem</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group form-inline">
                                                        <label for="hp" class="col-xs-4 col-md-4 col-form-label mb-1">Pontos de Vida:</label>
                                                        <input type="number" class="form-control mb-3 col-xs-12 col-md-7" id="hp" name="hp" value="<?php echo $row['hp'] ?>">
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="ferimentos" class="col-xs-4 col-md-4 col-form-label mb-1">Ferimentos:</label>
                                                        <input type="number" class="form-control mb-3 col-xs-12 col-md-7" id="ferimentos" name="ferimentos" value="<?php echo $row['ferimentos'] ?>">
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="exaustao" class="col-xs-4 col-md-4 col-form-label mb-1">Exaustão:</label>
                                                        <input type="number" class="form-control mb-3 col-xs-12 col-md-7" id="exaustao" name="exaustao" value="<?php echo $row['exaustao'] ?>">
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="nivel" class="col-xs-4 col-md-4 col-form-label mb-1">Nível:</label>
                                                        <input type="number" class="form-control mb-3 col-xs-12 col-md-7" id="nivel" name="nivel" value="<?php echo $row['charnivel'] ?>">
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
                            <div>
                                <?php
                                $query3 = mysqli_query($connection, "SELECT atributos.id AS id, atributos.forca AS forca, atributos.destreza AS destreza, atributos.vitalidade AS vitalidade, atributos.inteligencia AS inteligencia, atributos.sabedoria AS sabedoria, atributos.determinacao AS determinacao, atributos.personalidade AS personalidade, atributos.labia AS labia, atributos.compostura AS compostura FROM atributos "
                                        . "INNER JOIN personagem ON personagem.id_atributos = atributos.id WHERE personagem.id = '$charid' LIMIT 1") or die("Problema na pesquisa");
                                $count3 = mysqli_num_rows($query3);
                                if ($count3 == 0) {
                                    printf("<header><strong>Nenhum resultado encontrado!</strong></header><hr>");
                                } else {
                                    while ($row = mysqli_fetch_array($query3)) {
                                        ?>
                                        <form action="code/edit_atributos" method="POST">
                                            <table class="table table-responsive table-sm">
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
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Escalada</th>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Montaria</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Natação</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Arrombamento</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Abrir Cadeados</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Desarmar Armadilhas</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Esconder-se</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Esgueirar-se</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Equilíbrio</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Roubar</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Truque de Mãos</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Usar Objeto</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Arcano</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Histórico</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Linguístico</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Médico</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Natural</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Conhecimento Religioso</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Identificação</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Investigação</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Intuição</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Percepção</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Rastreamento</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Sobrevivência</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Liderança</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Diplomacia</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Inspiração</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Intimidação</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Persuasão</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Adestramento</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Atuação</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Blefe</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Disfarce</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Enganação</th>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>

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
                                <?php
                                mysqli_close($connection);
                                ?>
                            </div>
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

                    document.getElementById("editar").addEventListener('click', (e) = > {
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