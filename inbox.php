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
        <link rel="stylesheet" src="css/inbox.css">

    </head>

    <body id="page-top">
        <?php
        include "code/connection.php";
        require "code/validation.php";
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
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="user">Perfil</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="code/logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="portfolio" id="personagens">
            <div class="container">
                <div class="row">
                    <h1 class="m-3">Mensagens</h1>
                    <div class="col-md-12 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-filter" data-target="sent">Enviadas</button>
                                        <button type="button" class="btn btn-secondary btn-filter" data-target="inbox">Recebidas</button>
                                        <button type="button" class="btn btn-info btn-filter" data-target="system">Sistema</button>
                                        <button type="button" class="btn btn-default btn-filter" data-target="all">Todas</button>
                                    </div>
                                </div>
                                <div class="table-container">
                                    <table class="table table-filter">
                                        <tbody>
                                            <tr data-status="pagado">
                                                <td>
                                                    <div class="ckbox">
                                                        <input type="checkbox" id="checkbox1">
                                                        <label for="checkbox1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <a href="#" class="pull-left">
                                                            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                            <h4 class="title">
                                                                Lorem Impsum
                                                                <span class="pull-right pagado">(Pagado)</span>
                                                            </h4>
                                                            <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr data-status="pendiente">
                                                <td>
                                                    <div class="ckbox">
                                                        <input type="checkbox" id="checkbox3">
                                                        <label for="checkbox3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <a href="#" class="pull-left">
                                                            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                            <h4 class="title">
                                                                Lorem Impsum
                                                                <span class="pull-right pendiente">(Pendiente)</span>
                                                            </h4>
                                                            <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr data-status="cancelado">
                                                <td>
                                                    <div class="ckbox">
                                                        <input type="checkbox" id="checkbox2">
                                                        <label for="checkbox2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <a href="#" class="pull-left">
                                                            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                            <h4 class="title">
                                                                Lorem Impsum
                                                                <span class="pull-right cancelado">(Cancelado)</span>
                                                            </h4>
                                                            <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr data-status="pagado" class="selected">
                                                <td>
                                                    <div class="ckbox">
                                                        <input type="checkbox" id="checkbox4" checked>
                                                        <label for="checkbox4"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star star-checked">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <a href="#" class="pull-left">
                                                            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                            <h4 class="title">
                                                                Lorem Impsum
                                                                <span class="pull-right pagado">(Pagado)</span>
                                                            </h4>
                                                            <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr data-status="pendiente">
                                                <td>
                                                    <div class="ckbox">
                                                        <input type="checkbox" id="checkbox5">
                                                        <label for="checkbox5"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <a href="#" class="pull-left">
                                                            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                            <h4 class="title">
                                                                Lorem Impsum
                                                                <span class="pull-right pendiente">(Pendiente)</span>
                                                            </h4>
                                                            <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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

            <script>
                $(document).ready(function () {

                    $('.star').on('click', function () {
                        $(this).toggleClass('star-checked');
                    });

                    $('.ckbox label').on('click', function () {
                        $(this).parents('tr').toggleClass('selected');
                    });

                    $('.btn-filter').on('click', function () {
                        var $target = $(this).data('target');
                        if ($target != 'all') {
                            $('.table tr').css('display', 'none');
                            $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
                        } else {
                            $('.table tr').css('display', 'none').fadeIn('slow');
                        }
                    });

                });

            </script>

    </body>

</html>