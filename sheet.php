<!DOCTYPE html>
<html lang="en">
    <?php
    if (isset($_POST['cod'])) {
        $cod = $_POST['cod'];
    } else {
        $cod = "z000";
    }
    ?>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

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
        require "code/validation.php";

        if (isset($_SESSION['idLogado'])) {
            $id = $_SESSION['idLogado'];
            $nome = $_SESSION['nomeLogado'];

            $charquery = mysqli_query($connection, "SELECT usuario.id, personagem.id AS charid, personagem.nome AS charnome, personagem.imagem AS charimg FROM usuario INNER JOIN personagem ON personagem.id_usuario = usuario.id WHERE usuario.id = '$id'") or die("Problema na pesquisa");
            $charcount = mysqli_num_rows($charquery);
            if ($charcount == 0) {
                $chars = "Você ainda não possui personagens";
                $charrows = 0;
            } elseif ($charcount == 1) {
                $chars = "Você possui $charcount personagem";
                $charrows = $charcount;
            } else {
                $chars = "Você possui $charcount personagens";
                $charrows = $charcount;
            }


            $aventuraquery = mysqli_query($connection, "SELECT *  FROM aventura WHERE codigo = '$cod'") or die("Problema na pesquisa");
            $aventuracount = mysqli_num_rows($aventuraquery);
            if ($aventuracount == 0) {
                $msg = "Esta aventura não existe";
            } else {
                while ($aventurarow = mysqli_fetch_array($aventuraquery)) {
                    $aventuraid = $aventurarow["id"];
                }
            }
        }
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
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="user">Personagens</a>
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
        <br>
        <div class="container">
            <h1 class="text-center text-uppercase text-secondary mb-0">Crie o seu Personagem!</h1>
            <section id="sheet">
                <form action="code/save_char.php" method="post" enctype="multipart/form-data">
                    <div class="accordion" id="accordion">
                        <!-- Dados -->
                        <div class="card z-depth-0 bordered">
                            <div class="card-header" id="headingNome">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseNome" aria-expanded="true" aria-controls="collapseNome">
                                        Nome
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseNome" class="collapse show" aria-labelledby="headingNome" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label>Nome</label>
                                        <input class="form-control" name="nome" id="nome" type="text" placeholder="Nome" required="required" data-validation-required-message="Nome do personagem!">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="id_aventura" name="id_aventura" value="<?php echo $aventuraid ?>">

                    <!-- Raça -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingRaca">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRaca" aria-expanded="false" aria-controls="collapseRaca">
                                    Raça
                                </button>
                            </h5>
                        </div>
                        <div id="collapseRaca" class="collapse" aria-labelledby="headingRaca" data-parent="#accordion">
                            <div class="card-body">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="anao" name="raca" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="anao">Anão</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="elfo" name="raca" class="custom-control-input"  value="2">
                                    <label class="custom-control-label" for="elfo">Elfo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="humano" name="raca" class="custom-control-input"  value="3">
                                    <label class="custom-control-label" for="humano">Humano</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="orc" name="raca" class="custom-control-input">
                                    <label class="custom-control-label" for="orc">Orc</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Classe -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingClasse">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseClasse" aria-expanded="false"
                                        aria-controls="collapseClasse">
                                    Classe
                                </button>
                            </h5>
                        </div>
                        <div id="collapseClasse" class="collapse" aria-labelledby="headingClasse" data-parent="#accordion">
                            <div class="card-body">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="guerreiro" name="classe" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="guerreiro">Guerreiro</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="feiticeiro" name="classe" class="custom-control-input" value="2">
                                                    <label class="custom-control-label" for="feiticeiro">Feiticeiro</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="trapaceiro" name="classe" class="custom-control-input" value="3">
                                                    <label class="custom-control-label" for="trapaceiro">Trapaceiro</label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio  custom-control-inline">
                                                <input type="radio" id="barbaro" name="subclasse" class="custom-control-input" disabled value="1">
                                                <label class="custom-control-label" for="barbaro">Bárbaro</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="bruxo" name="subclasse" class="custom-control-input" disabled value="5">
                                                <label class="custom-control-label" for="bruxo">Bruxo</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="bardo" name="subclasse" class="custom-control-input" disabled value="9">
                                                <label class="custom-control-label" for="bardo">Bardo</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio  custom-control-inline">
                                                <input type="radio" id="cavaleiro" name="subclasse" class="custom-control-input" disabled value="3">
                                                <label class="custom-control-label" for="cavaleiro">Cavaleiro</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="clerigo" name="subclasse" class="custom-control-input" disabled value="6">
                                                <label class="custom-control-label" for="clerigo">Clérigo</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="sabotador" name="subclasse" class="custom-control-input" disabled value="10">
                                                <label class="custom-control-label" for="sabotador">Sabotador</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio  custom-control-inline">
                                                <input type="radio" id="duelista" name="subclasse" class="custom-control-input" disabled value="4">
                                                <label class="custom-control-label" for="duelista">Duelista</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="druida" name="subclasse" class="custom-control-input" disabled value="7">
                                                <label class="custom-control-label" for="druida">Druida</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="ladrao" name="subclasse" class="custom-control-input" disabled value="11">
                                                <label class="custom-control-label" for="ladrao">Ladrão</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio  custom-control-inline">
                                                <input type="radio" id="cacador" name="subclasse" class="custom-control-input" disabled value="2">
                                                <label class="custom-control-label" for="cacador">Caçador</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="arcanista" name="subclasse" class="custom-control-input" disabled value="8">
                                                <label class="custom-control-label" for="arcanista">Arcanista</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="assassino" name="subclasse" class="custom-control-input" disabled value="12">
                                                <label class="custom-control-label" for="assassino">Assassino</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Sexo -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingSexo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSexo" aria-expanded="false"
                                        aria-controls="collapseSexo">
                                    Sexo
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSexo" class="collapse" aria-labelledby="headingSexo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="homem" name="sexo" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="homem">Homem</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mulher" name="sexo" class="custom-control-input"  value="2">
                                    <label class="custom-control-label" for="mulher">Mulher</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Idade -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingIdade">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseIdade" aria-expanded="false"
                                        aria-controls="collapseIdade">
                                    Idade
                                </button>
                            </h5>
                        </div>
                        <div id="collapseIdade" class="collapse" aria-labelledby="headingIdade" data-parent="#accordion">
                            <div class="card-body">
                                <div class="d-flex justify-content-center my-4">
                                    <span class="font-weight-bold purple-text mr-2 mt-1">Jovem</span>
                                    <div class="range-field w-75">
                                        <input class="custom-range" name="idade" type="range" min="1" max="20" value="11" id="idade" />
                                    </div>
                                    <span class="font-weight-bold purple-text ml-2 mt-1">Idoso</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Altura -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingAltura">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAltura" aria-expanded="false"
                                        aria-controls="collapseAltura">
                                    Altura
                                </button>
                            </h5>
                        </div>
                        <div id="collapseAltura" class="collapse" aria-labelledby="headingAltura" data-parent="#accordion">
                            <div class="card-body">
                                <div class="d-flex justify-content-center my-4">
                                    <span class="font-weight-bold purple-text mr-2 mt-1">Baixo</span>
                                    <div class="range-field w-75">
                                        <input class="custom-range" name="altura" type="range" min="1" max="20" value="11" id="altura" />
                                    </div>
                                    <span class="font-weight-bold purple-text ml-2 mt-1">Alto</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Peso -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingPeso">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePeso" aria-expanded="false"
                                        aria-controls="collapsePeso">
                                    Peso
                                </button>
                            </h5>
                        </div>
                        <div id="collapsePeso" class="collapse" aria-labelledby="headingPeso" data-parent="#accordion">
                            <div class="card-body">
                                <div class="d-flex justify-content-center my-4">
                                    <span class="font-weight-bold purple-text mr-2 mt-1">Leve</span>
                                    <div class="range-field w-75">
                                        <input class="custom-range" name="peso" type="range" min="1" max="20" value="10" id="peso" />
                                    </div>
                                    <span class="font-weight-bold purple-text ml-2 mt-1">Pesado</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Classe Social -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingSocial">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSocial" aria-expanded="false"
                                        aria-controls="collapseSocial">
                                    Classe Social
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSocial" class="collapse" aria-labelledby="headingSocial" data-parent="#accordion">
                            <div class="card-body">
                                <div class="custom-control custom-radio  custom-control-inline">
                                    <input type="radio" id="nobre" name="classe_social" class="custom-control-input"  value="1">
                                    <label class="custom-control-label" for="nobre">Nobre</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="burgues" name="classe_social" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="burgues">Burguês</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="servo" name="classe_social" class="custom-control-input"  value="3">
                                    <label class="custom-control-label" for="servo">Servo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="escravo" name="classe_social" class="custom-control-input"  value="4">
                                    <label class="custom-control-label" for="escravo">Escravo</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profissão -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingProfissao">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseProfissao" aria-expanded="false"
                                        aria-controls="collapseProfissao">
                                    Profissão
                                </button>
                            </h5>
                        </div>
                        <div id="collapseProfissao" class="collapse" aria-labelledby="headingProfissao" data-parent="#accordion">
                            <div class="card-body">
                                <table>
                                    <?php


            $profquery = mysqli_query($connection, "SELECT id, nome FROM profissao") or die("Problema na pesquisa");
            $profcount = mysqli_num_rows($profquery);
            if ($profcount == 0) {
                $profs = "Ocorreu um erro! Por favor, contate o administrador!";
                $profrows = 0;
            } else {
                while ($profrow = mysqli_fetch_array($profquery)) {
                    ?>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="<?php echo $profrow['nome'] ?>" name="profissao" class="custom-control-input"  value="<?php echo $profrow['id'] ?>">
                                                <label class="custom-control-label" for="<?php echo $profrow['nome'] ?>"><?php echo $profrow['nome'] ?></label>
                                            </div>
                                        </td>
                                    </tr>
                                        <?php
                        }
                    }
                    ?>


                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Imagem -->
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingImagem">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseImagem" aria-expanded="false"
                                        aria-controls="collapseSocial">
                                    Imagem
                                </button>
                            </h5>
                        </div>
                        <div id="collapseImagem" class="collapse" aria-labelledby="headingImagem" data-parent="#accordion">
                            <div class="card-body">
                                <!-- bootstrap-imageupload. -->
                                <div class="imageupload panel panel-default">
                                    <div class="panel-heading clearfix">
                                        <h3 class="panel-title pull-left">Escolher imagem</h3>
                                    </div>
                                    <div class="file-tab panel-body">
                                        <label class="btn btn-outline-secondary btn-file">
                                            <span>Pesquisar</span>
                                            <!-- The file is stored here. -->
                                            <input type="file" name="imagem" id="imagem">
                                        </label>
                                    </div>
                                    <div class="url-tab panel-body">
                                        <div class="input-group">
                                            <input type="text" class="form-control hasclear" placeholder="Imagem de URL">
                                        <div class="input-group-btn">
                                                <button type="button" class="btn btn-default">Escolher</button>
                                    </div>
                                </div>
                                        <button type="button" class="btn btn-default">Remover</button>
                                        <!-- The URL is stored here. -->
                                        <input type="hidden" name="imagem-url">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" id="salvar" class="btn btn-secondary">Salvar</button>
                    <a href="user" id="cancelar" class="btn btn-danger">Cancelar</a>
                    </div>
                    </div>
                    </div>
                    </div>
                </form>
            </section>

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
                var $imageupload = $('.imageupload');
                $imageupload.imageupload();

                $('#imageupload-disable').on('click', function () {
                    $imageupload.imageupload('disable');
                    $(this).blur();
                })

                $('#imageupload-enable').on('click', function () {
                    $imageupload.imageupload('enable');
                    $(this).blur();
                })

                $('#imageupload-reset').on('click', function () {
                    $imageupload.imageupload('reset');
                    $(this).blur();
                });
            </script>

            <script>
                // // Altura
                // var slideraltura = document.getElementById("altura");
                // var outputaltura = document.getElementById("valoraltura");
                // outputaltura.innerHTML = (slideraltura.value * 5); // Valor padrão

                // // Atualizar slider
                // slideraltura.oninput = function() {
                //     outputaltura.innerHTML = this.value;
                // }

                // // Peso
                // var sliderpeso = document.getElementById("peso");
                // var outputpeso = document.getElementById("valorpeso");
                // outputpeso.innerHTML = (sliderpeso.value * 5); // Valor padrão

                // // Atualizar slider
                // sliderpeso.oninput = function() {
                //     outputpeso.innerHTML = this.value;
                // }

                // // Idade
                // var slideridade = document.getElementById("idade");
                // var outputidade = document.getElementById("valoridade");
                // var valoridade = (15 + slideridade.value *4);
                // outputidade.innerHTML = valoridade; // Valor padrão

                // // Atualizar slider
                // slideridade.oninput = function() {
                //     outputidade.innerHTML = this.value;
                // }

                // Classes
                var guerreiro = document.getElementById("guerreiro");
                var feiticeiro = document.getElementById("feiticeiro");
                var trapaceiro = document.getElementById("trapaceiro");
                var sub_guerreiro1 = document.getElementById("barbaro");
                var sub_guerreiro2 = document.getElementById("cavaleiro");
                var sub_guerreiro3 = document.getElementById("duelista");
                var sub_guerreiro4 = document.getElementById("cacador");
                var sub_feiticeiro1 = document.getElementById("bruxo");
                var sub_feiticeiro2 = document.getElementById("clerigo");
                var sub_feiticeiro3 = document.getElementById("druida");
                var sub_feiticeiro4 = document.getElementById("arcanista");
                var sub_trapaceiro1 = document.getElementById("bardo");
                var sub_trapaceiro2 = document.getElementById("sabotador");
                var sub_trapaceiro3 = document.getElementById("ladrao");
                var sub_trapaceiro4 = document.getElementById("assassino");

                // Funções
                guerreiro.onclick = function () {
                    sub_guerreiro1.removeAttribute("disabled");
                    sub_guerreiro2.removeAttribute("disabled");
                    sub_guerreiro3.removeAttribute("disabled");
                    sub_guerreiro4.removeAttribute("disabled");
                    sub_guerreiro1.checked = true;
                    sub_feiticeiro1.disabled = true;
                    sub_feiticeiro2.disabled = true;
                    sub_feiticeiro3.disabled = true;
                    sub_feiticeiro4.disabled = true;
                    sub_trapaceiro1.disabled = true;
                    sub_trapaceiro2.disabled = true;
                    sub_trapaceiro3.disabled = true;
                    sub_trapaceiro4.disabled = true;

                }

                feiticeiro.onclick = function () {
                    sub_guerreiro1.disabled = true;
                    sub_guerreiro2.disabled = true;
                    sub_guerreiro3.disabled = true;
                    sub_guerreiro4.disabled = true;
                    sub_feiticeiro1.removeAttribute("disabled");
                    sub_feiticeiro2.removeAttribute("disabled");
                    sub_feiticeiro3.removeAttribute("disabled");
                    sub_feiticeiro4.removeAttribute("disabled");
                    sub_feiticeiro1.checked = true;
                    sub_trapaceiro1.disabled = true;
                    sub_trapaceiro2.disabled = true;
                    sub_trapaceiro3.disabled = true;
                    sub_trapaceiro4.disabled = true;

                }

                trapaceiro.onclick = function () {
                    sub_guerreiro1.disabled = true;
                    sub_guerreiro2.disabled = true;
                    sub_guerreiro3.disabled = true;
                    sub_guerreiro4.disabled = true;
                    sub_feiticeiro1.disabled = true;
                    sub_feiticeiro2.disabled = true;
                    sub_feiticeiro3.disabled = true;
                    sub_feiticeiro4.disabled = true;
                    sub_trapaceiro1.removeAttribute("disabled");
                    sub_trapaceiro2.removeAttribute("disabled");
                    sub_trapaceiro3.removeAttribute("disabled");
                    sub_trapaceiro4.removeAttribute("disabled");
                    sub_trapaceiro1.checked = true;

                }

                $(':radio').each(function () {
                    if ($(this).is(':disabled')) {
                        $(this).checked = false;
                    }
                });
            </script>

    </body>

</html>