<?php
    include_once '../../Control/Usuario_Control.php';
    $user = new Usuario_Control();
    $dados = $user->VerUsuarios();

    function msg($msg, $type){
        echo "
            <div class='alert alert-$type' role='alert'>
                $msg
            </div>
        ";
    }

    if (isset($_SESSION['user_id'])) {
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Usuários</title>

        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

        <!-- Modal de deletar Usuario -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apagar Usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="gerencia_users.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" id="delete_id">
                            <h4> Você tem certeza que deseja apagar esse Usuário? </h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Não </button>
                            <button type="submit" name="deletedata" class="btn btn-danger"> Sim, deletar!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="../home.php" class="nav-link">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../Control/Logout.php">Sair</a>
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
                            <a href="../clientes/home_clientes.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="home_users.php" class="nav-link active">
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
                                <h1 class="m-0 text-dark">Usuários</h1>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight mb-3">
                            <div class="d-flex justify-content-end">
                                <a href="gerencia_users.php" class="btn btn-success">Cadastrar +</a>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <?php 
                        if(isset($_SESSION['usuario_nao_cadastrado'])){
                            msg("Ocorreu um erro e não foi possivel cadastrar o usuário!", "danger");
                            unset($_SESSION['usuario_nao_editado']);
                        } else if(isset($_SESSION['usuario_nao_cadastrado'])){
                            msg("Ocorreu um erro e não foi possivel editar o usuário!", "danger");
                            unset($_SESSION['usuario_nao_editado']);
                        } else if(isset($_SESSION['usuario_nao_apagado'])){
                            msg("Ocorreu um erro e não foi possivel apagar o usuário!", "danger");
                            unset($_SESSION['usuario_nao_apagado']);
                        } else if(isset($_SESSION['usuario_cadastrado'])){
                            msg("Usuário Cadastrado Sucesso!", "success");
                            unset($_SESSION['usuario_cadastrado']);
                        } else if(isset($_SESSION['usuario_editado'])){
                            msg("Usuário Editado Com Sucesso!", "success");
                            unset($_SESSION['usuario_editado']);
                        } else if(isset($_SESSION['usuario_apagado'])){
                            msg("Usuário Excluido Sucesso!", "success");
                            unset($_SESSION['usuario_apagado']);
                        }
                     ?>
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Usuários</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>Nome</th>
                                            <th>Login</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php 
                                                foreach ($dados as $d) {
                                                    echo "<tr>";
                                                    echo "<td>".$d['id']."</td>";
                                                    echo "<td>".$d['nome']."</td>";
                                                    echo "<td>".$d['login']."</td>";
                                                    echo "<td>";
                                                    echo "<a href='gerencia_users.php?id=".$d['id']."' class='btn btn-info'>
                                                        <i class='fas fa-edit'></i>
                                                    </a>";
                                                    echo "<a class='btn btn-danger  btn-delete'>
                                                        <i class='fas fa-trash'></i>
                                                    </a>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
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

        <script>
            $(document).ready(function() {
                $('.btn-delete').on('click', function(){
                $('#deletemodal').modal('show');  
                
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);  
                document.getElementById("delete_id").value = data[0];
                });
            });
        </script>
    </body>
</html>
<?php 
    }else{
        header('Location: ../index.php');
    }
?>