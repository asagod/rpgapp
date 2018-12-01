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

</head>

<body id="page-top">

    <?php include "code/connection.php";
    session_start();

    if (isset($_GET['report'])) {
        $report = ($_GET['report']);
        ?>
        <script>
            alert("Você foi denunciado muitas vezes! O administrador do site decidiu baní-lo! Entre em contato para tentar recuperar a sua conta!");
        </script>
        <?php
        } else {
        header("Location: ");
    }

$textquery = mysqli_query($connection, "SELECT * FROM informacoes") or die("Problema na pesquisa");
$textrows = mysqli_num_rows($textquery);
if ($textrows == 0) {
    $msg = "Erro!";
} else {
    $msg = "Sucesso!!!";
}
?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Início</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button"
                data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#rules">Manual</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#download">Arquivos</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo (!isset($_SESSION['idLogado'])) ? '#login' : 'user';?>"><?php echo (!isset($_SESSION['idLogado'])) ? 'Login' : 'Perfil';?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
        <div class="container">
            <img class="img-fluid mb-5 d-block mx-auto" src="img/scar.png" alt="Carregamento da imagem falhou!">
            <h1 class="text-uppercase mb-0">S.C.A.R.</h1>
            <hr class="star-light">
            <h2 class="font-weight-light mb-0">Sistema de Combate Avançado para RPGs</h2>
        </div>
    </header>

    <!-- Rule Grid Section -->
    <section class="portfolio" id="rules">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Manual</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <br>
                <?php if ($textrows != 0) {
    while ($textrow = mysqli_fetch_array($textquery)) {
        ?>
                <div class="col-md-6 col-lg-4">
                    <a class="portfolio-item d-block mx-auto" href="#<?php echo $textrow['slug']; ?>">
                        <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                            <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                                <i class="fas fa-search-plus fa-3x"></i>
                                <p>
                                    <?php echo $textrow['titulo']; ?>
                                </p>
                            </div>
                        </div>
                        <img class="img-fluid" src="img/modal/<?php echo $textrow['img'] ?>" alt="Carregamento da imagem falhou!">
                    </a>
                </div>
                <?php
}
}?>
            </div>
        </div>
    </section>


    <!-- download Section -->
    <section class="bg-primary text-white mb-0" id="download">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Arquivos</h2>
            <hr class="star-light mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">S.C.A.R. é um conjunto de regras de RPG disponibilizadas gratuitamente através
                        deste site. Ao baixá-las você concorda
                        em não vender ou lucrar de qualquer modo com a utilização deste produto. Caso encontre
                        problemas no download ou erros
                        em algum dos arquivos, reporte-os através do e-mail encontrado na área de contato do site.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">Os arquivos PDF contém as regras e listas disponíveis no site, assim como as cartas
                        para impressão. </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a class="btn btn-xl btn-outline-light" href="http://localhost/RPGApp/download/download.php?download_file=all-files.zip">
                    <i class="fas fa-download mr-2"></i>
                    Baixe Agora!
                </a>
            </div>
        </div>
    </section>

<?php if (!isset($_SESSION['idLogado'])) {
     ?>
    <!-- login Section -->
    <section id="login">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Login</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="login" id="login" novalidate="novalidate" action="code/verify.php" method="POST">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Login</label>
                                <input class="form-control" name="nome" id="nome" type="text" placeholder="Login"
                                    required="required" data-validation-required-message="Digite seu login.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Senha</label>
                                <input class="form-control" name="senha" id="senha" type="password" placeholder="Senha"
                                    required="required" data-validation-required-message="Digite sua senha.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div id="success"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl" id="loginButton">Entrar</button>
                        </div>
                        <small for="Cadastro" class="form-group controls col-md-12">Não possui conta?
                            <a href="#cadastro-modal" class="portfolio-item">Cadastre-se!</a>
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </section>

    
    <?php  


} else{
    $id = $_SESSION['idLogado'];
    $nome = $_SESSION['nomeLogado'];

}
    ?>

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

    <!-- Portfolio Modals -->
    <?php
$textquery2 = mysqli_query($connection, "SELECT * FROM informacoes") or die("Problema na pesquisa");
$textrows2 = mysqli_num_rows($textquery2);
if ($textrows2 == 0) {
    $msg2 = "Erro!";
} else {
    while ($textrow2 = mysqli_fetch_array($textquery2)) {
        ?>
    <div class="portfolio-modal mfp-hide" id="<?php echo $textrow2['slug']; ?>">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-secondary text-uppercase mb-0">
                            <?php echo $textrow2['titulo']; ?>
                        </h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="img/modal/<?php echo $textrow2['img']; ?>" alt="">
                        <p class="mb-5">
                            <?php echo $textrow2['descricao']; ?>
                        </p>
                        <a class="btn btn-primary btn-lg rounded-pill" href="http://localhost/RPGApp/download/download.php?download_file=<?php echo $textrow2['file']; ?>">
                            <i class="fa fa-close"></i>
                            Baixar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
}
    ?>
    <!-- Login -->
    <div class="portfolio-modal mfp-hide" id="cadastro-modal">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <form action="code/signup.php" method="POST">
                            <div class="form-group">
                                <label for="login">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Digite seu nome">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha"  aria-describedby="loginHelp" placeholder="Digite uma senha"
                                    onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Sua senha deve ter no mínimo 8 caracteres, pelo menos uma letra maiúscula e minúscula, além de no mínimo um número!"
                                    data-toggle="tooltip" data-placement="top">
                                <br>
                                <input type="password" class="form-control" id="repete" name="repete" placeholder="Digite a senha novamente"
                                    onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Sua senha deve ter no mínimo 8 caracteres, pelo menos uma letra maiúscula e minúscula, além de no mínimo um número!">
                                <span id='cadastroMensagem'></span>
                            </div>
                            <button type="submit" id="cadastrar" class="btn btn-outline-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var check = function () {
            if (document.getElementById('senha').value ==
                document.getElementById('repete').value) {
                document.getElementById('cadastroMensagem').style.color = 'green';
                document.getElementById('cadastroMensagem').innerHTML =
                    'Senhas iguais! Clique em cadastrar para continuar!';
                document.getElementById('cadastrar').disabled = false;
                document.getElementById('cadastrar').class = "active";
            } else {
                document.getElementById('cadastroMensagem').style.color = 'red';
                document.getElementById('cadastroMensagem').innerHTML =
                    'As senhas precisam ser iguais! Tente novamente!';
                document.getElementById('cadastrar').disabled = true;
                document.getElementById('cadastrar').class = "disabled";
            }
        }
    </script>

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