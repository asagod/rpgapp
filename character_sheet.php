<!DOCTYPE html>
<html lang="en">
<?php
if (isset($POST['codigo'])) {

}

if (isset($_GET['id'])) {
    $charid = ($_GET['id']);
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
    <link href="css/bootstrap-imageupload.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php include "code/connection.php";
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
    <div class="container">
<div class="row">
    <section>
    <div class="col-lg-9">
                    <?php
if (isset($_SESSION['idLogado'])) {
    $userId = $_SESSION['idLogado'];
}
$query = mysqli_query($connection, "SELECT * FROM personagem WHERE id = '$charid'") or die("Problema na pesquisa");
$count = mysqli_num_rows($query);
if ($count == 0) {
    printf("<header><strong>Este produto não foi encontrado!</strong></header>");
} else {
    while ($row = mysqli_fetch_array($query)) {
        ?>

                            <div class="card mt-4">
                                <img class="card-img-top img-fluid" src="img/personagem/<?php echo $row['imagem'] ?>" alt="Imagem do personagem">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $row['nome'] ?>, <?php echo $row['id_subclasse'] ?> <?php echo $row['id_raca']; ?></h3>
                                    <hr>
                                    <h4>HP: <?php echo $row['hp'] ?>/<?php echo $row['maxhp'] ?></h4>
                                    <p class="card-text">Ferimentos: 0/<?php echo $row['ferimentos'] ?></p>
                                    <p class="card-text">Exaustão: 0/<?php echo $row['exaustao'] ?></p>
                                    <span class="text-warning"></span>
                                    <hr>
                                    <button type="button" data-target="#editar-modal" data-toggle="modal" class="btn btn-secondary">Editar</button>
                                </div>
                            </div>
         <?php
}
}
?>
                    <!-- /.card -->
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                            Atributos
                        </div>
                        <!-- MODAL -->
                        <div class="modal" tabindex="-1" role="dialog" id="editar-modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="atributo" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Atributos</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" class="form-control" id="atributo" name="atributo">
                                            <input type="text" class="form-control" id="forca" name="forca">
                                            <input type="text" class="form-control" id="destreza" name="destreza">
                                            <input type="text" class="form-control" id="vitalidade" name="vitalidade">
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
                        <div class="card-body">
                            <?php
$query2 = mysqli_query($connection, "SELECT atributos.forca AS forca, atributos.destreza AS destreza, atributos.vitalidade AS vitalidade, atributos.inteligencia AS inteligencia, atributos.sabedoria AS sabedoria, atributos.determinacao AS determinacao, atributos.personalidade AS personalidade, atributos.labia AS labia, atributos.compostura AS compostura FROM atributos "
    . "INNER JOIN personagem ON personagem.id_atributos = atributos.id WHERE personagem.id = '$charid' LIMIT 1") or die("Problema na pesquisa");
$count2 = mysqli_num_rows($query2);
if ($count2 == 0) {
    printf("<header><strong>Nenhum resultado encontrado!</strong></header><hr>");
} else {
    while ($row = mysqli_fetch_array($query2)) {
        ?>
                                    <p>Força: <?php echo $row['forca'] ?> (5)</p>
                                    <p>Destreza: <?php echo $row['destreza'] ?> (3)</p>
                                    <p>Vitalidade: <?php echo $row['vitalidade'] ?> (4)</p>
                                    <p>Inteligência: <?php echo $row['inteligencia'] ?> (0)</p>
                                    <p>Sabedoria: <?php echo $row['sabedoria'] ?> (0)</p>
                                    <p>Determinação: <?php echo $row['determinacao'] ?> (0)</p>
                                    <p>Personalidade: <?php echo $row['personalidade'] ?></p>
                                    <p>Lábia: <?php echo $row['labia'] ?></p>
                                    <p>Compostura: <?php echo $row['compostura'] ?></p>
                                    <hr>
                                    <?php
}
}
?>
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editar-modal">Editar</button>
<?php
mysqli_close($connection);
?>
                        </div>
                        <!-- /.card -->
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
    </script>

    <script>
        // Altura
        var slideraltura = document.getElementById("altura");
        var outputaltura = document.getElementById("valoraltura");
        outputaltura.innerHTML = (slideraltura.value * 5); // Valor padrão

        // Atualizar slider
        slideraltura.oninput = function() {
            outputaltura.innerHTML = this.value;
        }

        // Peso
        var sliderpeso = document.getElementById("peso");
        var outputpeso = document.getElementById("valorpeso");
        outputpeso.innerHTML = (sliderpeso.value * 5); // Valor padrão

        // Atualizar slider
        sliderpeso.oninput = function() {
            outputpeso.innerHTML = this.value;
        }

        // Idade
        var slideridade = document.getElementById("idade");
        var outputidade = document.getElementById("valoridade");
        outputidade.innerHTML = (15 + slideridade.value * 4); // Valor padrão

        // Atualizar slider
        slideridade.oninput = function() {
            outputidade.innerHTML = this.value;
        }

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
    guerreiro.onclick = function() {
        sub_guerreiro1.removeAttribute("disabled");
        sub_guerreiro2.removeAttribute("disabled");
        sub_guerreiro3.removeAttribute("disabled");
          sub_guerreiro4.removeAttribute("disabled");
          sub_guerreiro1.checked= true;
          sub_feiticeiro1.disabled=true;
          sub_feiticeiro2.disabled=true;
          sub_feiticeiro3.disabled=true;
          sub_feiticeiro4.disabled=true;
          sub_trapaceiro1.disabled=true;
          sub_trapaceiro2.disabled=true;
          sub_trapaceiro3.disabled=true;
        sub_trapaceiro4.disabled=true;

    }

    feiticeiro.onclick = function() {
        sub_guerreiro1.disabled=true;
        sub_guerreiro2.disabled=true;
        sub_guerreiro3.disabled=true;
          sub_guerreiro4.disabled=true;
          sub_feiticeiro1.removeAttribute("disabled");
          sub_feiticeiro2.removeAttribute("disabled");
          sub_feiticeiro3.removeAttribute("disabled");
          sub_feiticeiro4.removeAttribute("disabled");
        sub_feiticeiro1.checked=true;
          sub_trapaceiro1.disabled=true;
          sub_trapaceiro2.disabled=true;
          sub_trapaceiro3.disabled=true;
        sub_trapaceiro4.disabled=true;

    }

    trapaceiro.onclick = function() {
        sub_guerreiro1.disabled=true;
        sub_guerreiro2.disabled=true;
        sub_guerreiro3.disabled=true;
          sub_guerreiro4.disabled=true;
          sub_feiticeiro1.disabled=true;
          sub_feiticeiro2.disabled=true;
          sub_feiticeiro3.disabled=true;
          sub_feiticeiro4.disabled=true;
          sub_trapaceiro1.removeAttribute("disabled");
          sub_trapaceiro2.removeAttribute("disabled");
          sub_trapaceiro3.removeAttribute("disabled");
          sub_trapaceiro4.removeAttribute("disabled");
          sub_trapaceiro1.checked=true;

    }

    $(':radio').each(function(){
          if ($(this).is(':disabled')) {
        $(this).checked = false;
          }
    });
    </script>

</body>

</html>