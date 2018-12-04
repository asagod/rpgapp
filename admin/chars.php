<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>S.C.A.R. - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">
  <?php
        include "../code/connection.php";
        require "../code/validation.php";
        date_default_timezone_set('America/Sao_Paulo');

        if (isset($_SESSION['idLogado'])) {
            $id = $_SESSION['idLogado'];
            $nome = $_SESSION['nomeLogado'];
            $admin = $_SESSION['adminUsuario'];
            if ($admin != "2"){
                header("Location:../");
            } else{
            $charquery = mysqli_query($connection, "SELECT usuario.id AS userid, usuario.nome AS username, personagem.id AS charid, personagem.nome AS charnome, personagem.id_aventura AS aventura, aventura.nome AS campaign, personagem.imagem AS charimg, personagem.id_nivel AS charnivel, classe.nome AS charclasse, raca.nome AS charraca FROM usuario INNER JOIN personagem ON personagem.id_usuario = usuario.id INNER JOIN raca ON raca.id = personagem.id_raca INNER JOIN classe ON classe.id = personagem.id_classe INNER JOIN aventura ON aventura.id = personagem.id_aventura") or die("Problema na pesquisa");
            $charcount = mysqli_num_rows($charquery);
            if ($charcount == 0) {
                $chars = "Nenhum personagem cadastrado";
                $charrows = 0;
            } else if ($charcount == 1) {
                $chars = "$charcount personagem cadastrado";
                $charrows = $charcount;
            } else {
                $chars = "$charcount personagens cadastrados";
                $charrows = $charcount;
            }

        }

            $query = mysqli_query($connection, "SELECT * FROM informacoes") or die("Problema na pesquisa");
            $count = mysqli_num_rows($query);

          }
            ?>

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="../user">Site</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

     
    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Regras</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Arquivos:</h6>
            <?php  if ($count != 0) {
    while ($count = mysqli_fetch_array($query)) {
        ?>
            <a class="dropdown-item" href="../code/edit-text.php?id=<?php echo $count['id'] ?>"><?php echo $count['titulo'] ?></a>
            <?php
    }
}
            ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="404.html">Novo Arquivo</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Usuários</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="chars.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Personagens</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="camp.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Aventuras</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">26 New Messages!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">11 New Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">123 New Orders!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

        <!-- Tabela Personagens -->
        <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Personagens</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Usuário</th>
                      <th>Visibilidade/Aventura</th>
                      <th>Estado</th>
                      <th>Operações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
if ($charrows != 0) {
    while ($charrow = mysqli_fetch_array($charquery)) {
        ?>
                    <tr>
                      <td><?php echo $charrow['charid'] ?></td>
                      <td><?php echo $charrow['charnome']; ?></td>
                      <td><?php echo $charrow['username']; ?></td>
                      <td><?php echo $charrow['campaign']; ?></td>
                      <td><?php echo ($charrow['userid'] == "1") ? 'Inativo' : 'Ativo'; ?></td>
                      <td><a class="btn btn-success" href="#modal-restore-<?php echo $charrow['charid'] ?>" data-toggle="modal">Restaurar</a>
                          <a class="btn btn-info" href="../character_sheet.php?key=<?php echo (base64_encode($charrow['charid'])); ?>" onclick="return confirm('Saindo da tela de admin. Deseja continuar?')">Visualizar</a>
                          <a class="btn btn-warning" href="../code/disable_char.php?id=<?php echo $charrow['charid'] ?>" onclick="return confirm('Tem certeza que deseja tornar este personagem inativo?')">Desabilitar</a>
                          <a class="btn btn-danger" href="../code/delete_char.php?id=<?php echo $charrow['charid'] ?>" onclick="return confirm('Tem certeza que deseja excluir este personagem?')">Excluir</a></td>
                    </tr>
                      <div class="modal" tabindex="-1" role="dialog" id="modal-restore-<?php echo $charrow['charid'] ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="../code/restore.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Aventura</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="newowner" class="col-xs-12 col-form-label mb-1">Digite o ID do novo usuário:</label>
                                            <input type="text" class="form-control col-xs-8 col-md-4" id="newowner" name="newowner">
                                            <input type="hidden" id="newcharid" name="newcharid" value="<?php echo $charrow['charid'] ?>">
                                        </div>
                                    </div>                                        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Restaurar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  <?php
                        }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Atualizado em <?php echo date("d/m/Y") ?> às <?php echo date("H:i:s") ?></div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © S.C.A.R. 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>


    <script>
    $(document).ready(function() {
      $('#charTable').DataTable();
    } );
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>

  </body>

</html>

