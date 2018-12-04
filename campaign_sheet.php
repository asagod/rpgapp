<!DOCTYPE html>
<html lang="en">
<?php
    if (isset($_GET['key'])) {
        $id = (base64_decode($_GET['key']));
    } else {
        header("Location: user");
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

    </head>

    <body id="page-top">
        <?php
        include "code/connection.php";
        require "code/validation.php";

        if (isset($_SESSION['idLogado'])) {
            $userid = $_SESSION['idLogado'];
            $nome = $_SESSION['nomeLogado'];

            $query = mysqli_query($connection, "SELECT aventura.id AS id, aventura.nome AS nome, aventura.codigo AS codigo, aventura.imagem AS imagem, aventura.id_mestre AS idmestre, usuario.id, usuario.nome AS mestre FROM aventura INNER JOIN usuario ON usuario.id = aventura.id_mestre WHERE aventura.id ='$id'") or die("Problema na pesquisa");
            $count = mysqli_num_rows($query);
            if ($count == 0) {
                $camps = "Nenhuma aventura cadastrada";
                $rows = 0;
            } else if ($count == 1) {
                $chars = "$count aventura cadastrada";
                $rows = $count;
            } else {
                $chars = "$count aventuras cadastradas";
                $rows = $count;
            }

            $charquery = mysqli_query($connection, "SELECT * FROM personagem WHERE personagem.id_aventura = '$id' AND personagem.id_usuario != '$userid'") or die("Problema na pesquisa");
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

            $npcquery = mysqli_query($connection, "SELECT * FROM personagem WHERE personagem.id_aventura = '$id' AND personagem.id_usuario = '$userid'") or die("Problema na pesquisa");
            $npccount = mysqli_num_rows($npcquery);
            if ($npccount == 0) {
                $npcaigns = "!";
                $npcrows = 0;
            } else if ($npccount == 1) {
                $npcaigns = " e possui $npccount aventura!";
                $npcrows = $npccount;
            } else {
                $npcaigns = " e possui $npccount aventuras!";
                $npcrows = $npccount;
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
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#aventuras">NPCs</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="user">Perfil</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="code/logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if ($rows != 0) {
    while ($row = mysqli_fetch_array($query)) {
        ?>

            <header class="masthead bg-primary text-white text-center">
            <div class="container">
                <img class="img-fluid mb-5 d-block mx-auto profimg" src="img/aventura/<?php echo $row['imagem']; ?>" alt="Carregamento da imagem falhou!">
                <h1 class="text-uppercase mb-0">
                <?php echo $row['nome']; ?>
                </h1>
                <hr class="star-light">
                <h2 class="font-weight-light mb-0">
                Código: <?php echo $row['codigo']; ?>
                </h2>
            </div>
        </header>
            <?php
                        }
                    }
                    ?>

        <!-- Character Grid Section -->
        <?php
if ($charrows != 0) {
    ?>
        <br>
        <section class="portfolio" id="personagens">
            <div class="container">
                <h2 class="text-center text-uppercase text-secondary mb-0">Personagens</h2>
                <hr class="star-dark mb-5">

                <div class="row">
                    <br>
    <?php
    while ($charrow = mysqli_fetch_array($charquery)) {
        ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow">
                                    <a href="character_sheet?key=<?php echo (base64_encode($charrow['id'])); ?>">
                                        <img class="card-img-top img-fluid img-char" src="img/personagem/<?php echo $charrow['imagem'] ?>" alt="Imagem não encontrada">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="character_sheet?key=<?php echo (base64_encode($charrow['id'])); ?>">
                                                <?php echo $charrow['nome']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Nível
                                            <?php echo $charrow['id_nivel'] ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </section>

        <!-- Adventure Grid Section -->
        <br>
        <section class="bg-primary text-white mb-0" id="aventuras">
            <div class="container">
                <h2 class="text-center text-uppercase text-white mb-0">NPCs</h2>
                <hr class="star-light mb-5">

                <div class="row">
                <?php
if ($npcrows != 0) {
    while ($npcrow = mysqli_fetch_array($npcquery)) {
        ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow">
                                    <a href="character_sheet?key=<?php echo (base64_encode($npcrow['id'])); ?>">
                                        <img class="card-img-top img-fluid img-char" src="img/personagem/<?php echo $npcrow['imagem'] ?>" alt="Imagem não encontrada">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="character_sheet?key=<?php echo (base64_encode($npcrow['id'])); ?>">
                                                <?php echo $npcrow['nome']; ?>
                                            </a>
                                        </h4>
                                        </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Nível
                                            <?php echo $npcrow['id_nivel'] ?>
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
                    <form action="sheet" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Aventura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nome" class="col-xs-12 col-md-8 col-form-label mb-1">Digite um nome para a aventura:</label>
                                <input type="text" class="form-control col-xs-12 col-md-12" id="nome" name="nome">
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