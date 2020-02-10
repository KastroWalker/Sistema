<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Victor Castro">

        <title>Login</title>
        
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">Login</div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Faça Login</p>
                    
                    <?php 
                        if(isset($_SESSION['nao_cadastrado'])){
                            echo '<div class="alert alert-danger">
                                    <strong>Erro!</strong> Usuário ou senha incorreto.
                                  </div>';
                        }unset($_SESSION['nao_cadastrado']);
                        if(isset($_SESSION['robo'])){
                            echo '<div class="alert alert-danger">
                                      <strong>Error!</strong> Parece que você não é um Humano °-°.
                                  </div>';
                        }unset($_SESSION['robo']);
                    ?>
                    
                    <form action="Control/Usuario_Control.php?acao=login" method="POST" name="form_login">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="user" placeholder="Usuário" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <button type="submit" name="entrar" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <input type="hidden" id="token" name="token">
                    </form>
                </div>
            </div>
        </div>

        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="dist/js/adminlte.min.js"></script>

        <?php 
            if(@$_SESSION['error'] >= 5){
        ?>
                <script src="https://www.google.com/recaptcha/api.js?render=6LdfStcUAAAAALP9Y7l8jcyRY1kMWh0CgfkABLZG"></script>
                
                <script>
                    document.form_login.action = "Control/Usuario_Control.php?acao=login&&captcha=true";

                    grecaptcha.ready(function() {
                        grecaptcha.execute('6LdfStcUAAAAALP9Y7l8jcyRY1kMWh0CgfkABLZG', {action: 'homepage'}).then(function(token) {
                        document.getElementById("token").value = token;
                        });
                    });
                </script>
        <?php 
            }
        ?>
    </body>
</html>
