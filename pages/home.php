<?php 
    session_start();

    include_once '../DB/Conexao.php';

    $connection = new Conexao();

    $sql = "SELECT COUNT(*) FROM cliente";
    $d = $connection->connect();
    $dados = $d->prepare($sql);
    $dados->execute();

    $cliente = $dados->fetchColumn();

    $sql = "SELECT COUNT(*) FROM usuario";
    $d = $connection->connect();
    $dados = $d->prepare($sql);
    $dados->execute();

    $user = $dados->fetchColumn();
    if (isset($_SESSION['user_id'])) {
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="author" content="Victor Castro">

        <title>Home Sistema</title>

        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="home.php" class="nav-link">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Control/Logout.php">Sair</a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="index.html" class="brand-link">
                    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Minha Empresa</span>
                </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/icon_user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['nome_user']; ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link  active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="clientes/home_clientes.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="usuarios/home_users.php" class="nav-link">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>Usuários</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            </aside>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Home</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><a href="clientes/home_clientes.php"><i class="fas fa-users"></i></a></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Clientes</span>
                                        <span class="info-box-number"><?php echo $cliente; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-warning elevation-1"><a href="usuarios/home_users.php"><i class="fas fa-users"></i></a></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Usuários</span>
                                        <span class="info-box-number"><?php echo $user; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer text-center">
                <strong>Copyright &copy; 2020 <a href="https://kastrowalker.github.io/" target="_blank">KastroWalker</a>.</strong>
                Todos os Direitos Reservados
            </footer>
        </div>

        <script src="../plugins/jquery/jquery.min.js"></script>
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="../dist/js/adminlte.js"></script>
        <script src="../dist/js/demo.js"></script>
        <script src="../dist/js/pages/dashboard2.js"></script>
    </body>
</html>
<?php 
    }else{
        header('Location: ../index.php');
    }
?>