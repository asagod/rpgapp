<!DOCTYPE html>
<html lang="en">

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

    </head>

    <body id="page-top">
        <?php
        include "code/connection.php";
        require "code/validation.php";

        if (isset($_SESSION['idLogado'])) {
            $id = $_SESSION['idLogado'];
            $nome = $_SESSION['nomeLogado'];
            $admin = $_SESSION['adminUsuario'];



            $charquery = mysqli_query($connection, "SELECT usuario.id, personagem.id AS charid, personagem.nome AS charnome, personagem.imagem AS charimg, personagem.id_nivel AS charnivel, classe.nome AS charclasse, raca.nome AS charraca FROM usuario INNER JOIN personagem ON personagem.id_usuario = usuario.id INNER JOIN raca ON raca.id = personagem.id_raca INNER JOIN classe ON classe.id = personagem.id_classe WHERE usuario.id = '$id'") or die("Problema na pesquisa");
            $charcount = mysqli_num_rows($charquery);
            if ($charcount == 0) {
                $chars = "Você ainda não possui personagens";
                $charrows = 0;
            } else if ($charcount == 1) {
                $chars = "Você possui $charcount personagem";
                $charrows = $charcount;
            } else {
                $chars = "Você possui $charcount personagens";
                $charrows = $charcount;
            }

            $campquery = mysqli_query($connection, "SELECT usuario.id, aventura.id AS campid, aventura.nome AS campnome, aventura.imagem AS campimg, aventura.pontos AS camppontos, aventura.codigo AS codigo FROM usuario INNER JOIN aventura ON aventura.id_mestre = usuario.id WHERE usuario.id = '$id'") or die("Problema na pesquisa");
            $campcount = mysqli_num_rows($campquery);
            if ($campcount == 0) {
                $campaigns = "!";
                $camprows = 0;
            } else if ($campcount == 1) {
                $campaigns = " e possui $campcount aventura!";
                $camprows = $campcount;
            } else {
                $campaigns = " e possui $campcount aventuras!";
                $camprows = $campcount;
            }
        }
        ?>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../RPGApp">Página Inicial</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button"
                        data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                        aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#personagens">Personagens</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#aventuras">Aventuras</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo ($admin!="2") ? 'inbox' : 'admin/index'; ?>"><?php echo ($admin!="2") ? 'Mensagens' : 'Admin'; ?></a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="code/logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header class="masthead bg-primary text-white text-center">
            <div class="container">
                <img class="img-fluid mb-5 d-block mx-auto" src="img/profile.png" alt="Carregamento da imagem falhou!">
                <h1 class="text-uppercase mb-0">
<?php echo ($nome); ?>
                </h1>
                <hr class="star-light">
                <h2 class="font-weight-light mb-0">
<?php echo ($chars) . ($campaigns); ?>
                </h2>
            </div>
        </header>

        <!-- Character Grid Section -->

        <section class="portfolio" id="personagens">
            <div class="container">
                <h2 class="text-center text-uppercase text-secondary mb-0">Personagens</h2>
                <hr class="star-dark mb-5">

                <div class="row">
                    <br>
<?php
if ($charrows != 0) {
    while ($charrow = mysqli_fetch_array($charquery)) {
        ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow">
                                    <a href="character_sheet?key=<?php echo (base64_encode($charrow['charid'])); ?>">
                                        <img class="card-img-top img-fluid img-char" src="img/personagem/<?php echo $charrow['charimg'] ?>" alt="Imagem não encontrada">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="character_sheet?key=<?php echo (base64_encode($charrow['charid'])); ?>">
                                                <?php echo $charrow['charnome']; ?>
                                            </a>
                                        </h4>
                                        <h5>
                                            <?php echo $charrow['charraca']; ?>
                                        </h5>
                                        <p class="card-text">
                                            <?php echo $charrow['charclasse']; ?>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Nível
                                            <?php echo $charrow['charnivel'] ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <a class="d-block mx-auto shadow" href="#modal-aventura-novo" data-toggle="modal">
                            <img class="img-fluid" src="img/new/personagem.png" alt="Carregamento da imagem falhou!">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Adventure Grid Section -->
        <br>
        <section class="bg-primary text-white mb-0" id="aventuras">
            <div class="container">
                <h2 class="text-center text-uppercase text-white mb-0">Aventuras</h2>
                <hr class="star-light mb-5">

                <div class="row">
                    <?php
                    if ($camprows != 0) {
                        while ($camprow = mysqli_fetch_array($campquery)) {
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow bg-secondary">
                                    <a href="campaign_sheet?key=<?php echo (base64_encode($camprow['campid'])); ?>">
                                        <img class="card-img-top img-fluid img-camp" src="img/aventura/<?php echo $camprow['campimg'] ?>" alt="Imagem não encontrada">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a class="text-white" href="campaign_sheet?key=<?php echo (base64_encode($camprow['campid'])); ?>">
                                                <?php echo $camprow['campnome']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="card-footer text-white">
                                        <?php echo $camprow['codigo']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <a class="d-block mx-auto shadow" href="#modal-aventura" data-toggle="modal">
                            <img class="img-fluid" src="img/new/aventura.png" alt="Carregamento da imagem falhou!">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Personagem -> Aventura -->
        <div class="modal" tabindex="-1" role="dialog" id="modal-aventura-novo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="sheet" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Aventura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cod" class="col-xs-12 col-md-8 col-form-label mb-1">Digite o código da aventura:</label>
                                <input type="text" class="form-control col-xs-12 col-md-12" id="cod" name="cod">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Aventura -->
        <div class="modal" tabindex="-1" role="dialog" id="modal-aventura">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="code/save_aventura.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Aventura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="aventuranome" class="col-xs-12 col-md-8 col-form-label mb-1">Digite um nome para a aventura:</label>
                                <input type="text" class="form-control col-xs-12 col-md-12" id="aventuranome" name="aventuranome">
                                <label for="pontos" class="col-xs-12 col-md-8 col-form-label mb-1">Pontuação:</label>
                                <input type="number" class="form-control col-xs-12 col-md-12" name="pontos">
                                <!-- Imagem -->
                                <label for="imagem" class="col-xs-12 col-md-8 col-form-label mb-1">Escolha uma imagem:</label>
                                <!-- bootstrap-imageupload. -->
                                <div class="imageupload panel panel-default">
                                    <div class="file-tab panel-body">
                                        <label class="btn btn-outline-secondary btn-file">
                                            <span>Pesquisar</span>
                                            <!-- The file is stored here. -->
                                            <input type="file" name="imagem" id="imagem">
                                        </label>
                                    </div>
                                        <button type="button" class="btn btn-default">Remover</button>
                                        <!-- The URL is stored here. -->
                                        <input type="hidden" name="imagem-url">
                                </div>
                                </div>
                            </div>                                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
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
        <div class="scroll-to-top d-lg-none position-fixed ">
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

    </body>

</html>