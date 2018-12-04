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
            $query = mysqli_query($connection, "SELECT aventura.id AS id, aventura.nome AS nome, aventura.codigo AS codigo, aventura.id_mestre AS idmestre, usuario.id, usuario.nome AS mestre FROM aventura INNER JOIN usuario ON usuario.id = aventura.id_mestre") or die("Problema na pesquisa");
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

        }

            $aquery = mysqli_query($connection, "SELECT * FROM informacoes") or die("Problema na pesquisa");
            $acount = mysqli_num_rows($aquery);

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
            <?php  if ($acount != 0) {
    while ($acount = mysqli_fetch_array($aquery)) {
        ?>
            <a class="dropdown-item" href="../code/edit-text.php?id=<?php echo $acount['id'] ?>"><?php echo $acount['titulo'] ?></a>
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
        <li class="nav-item">
          <a class="nav-link" href="chars.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Personagens</span></a>
        </li>
        <li class="nav-item active">
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
            <li class="breadcrumb-item active">Aventuras</li>
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

          <!-- Tabela Usuários -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Usuários</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Código</th>
                      <th>Mestre</th>
                      <th>Operações</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php  if ($rows != 0) {
    while ($row = mysqli_fetch_array($query)) {
        ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['codigo']; ?></td>
                        <td><?php echo $row['mestre']; ?></td>
                        <td><a href="code/disable_camp.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta aventura?')">Desabilitar</a>
                        </td>
                    </tr>
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

