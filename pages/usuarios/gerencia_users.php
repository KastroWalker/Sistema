<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Cadastra Cliente</title>

        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
                        <a href="../index.php" class="nav-link">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">Sair</a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="index.html" class="brand-link">
                <span class="brand-text font-weight-light">Minha Empresa</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="home_clientes.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../usuarios/home_users.php" class="nav-link active">
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
                                <h1 class="m-0 text-dark">Cadastrar Usuário</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro Usuário</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <label for="campo_nome">Nome*</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="campo_nome" name="nome" class="form-control" placeholder="Nome" required>
                                </div>
                                
                                <label for="campo_user">Usuário*</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="campo_user" name="user" placeholder="Usuário" required>
                                </div>

                                <label for="campo_senha">Senha*</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="campo_senha" name="senha" placeholder="Senha" required>
                                </div>

                                <div class="buttons">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                    <button type="reset" class="btn btn-info">Limpar</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                                <p><strong>Os Campos com * são obrigatório.</strong></p>
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
        
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="../../dist/js/adminlte.js"></script>
        <script src="../../dist/js/demo.js"></script>
        <script src="../../dist/js/pages/dashboard2.js"></script>
    </body>
</html>