<?php 
	session_start();
	include '../Model/Usuario_Model.php';
	include '../DB/Conexao.php';

	class Usuario_Control {
		private $data;
		private $connection;

		function __construct(){
			$this->data = new Usuario_Model();
			$this->connection = new Conexao();
		}

		function VerUsuarios(){
			$sql = "SELECT * FROM usuario";
			$d = $this->connection->connect();
			$dados = $d->prepare($sql);
			$dados->execute();
			return $dados;
		}

		function create($nome, $login, $senha){
			$this->data->setNome($nome);
			$this->data->setLogin($login);
			$this->data->setSenha($senha);

			$sql = "INSERT INTO usuario (nome, login, senha) VALUES (:nome, :login, :senha);";

			$d = $this->connection->connect();

			$data = $d->prepare($sql);
			$data->bindValue(":nome", $this->data->getNome());
			$data->bindValue(":login", $this->data->getLogin());
			$data->bindValue(":senha", $this->data->getSenha());

			try {
				$data->execute();
				$_SESSION['usuario_cadastrado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
			} catch (PDOException $ex) {
				echo "Erro ao cadastrar: ".$ex->getMessage();
				$_SESSION['usuario_nao_cadastrado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
			}
		}
		
		function read($id){
			$this->data->setId($id);

			$sql = "SELECT * FROM usuario WHERE id = :id";

	        $d = $this->connection->connect();
	        $data = $d->prepare($sql);
	        $data->bindValue(":id", $this->data->getId());
	        try {
		        $data->execute();
		        return $data;
	        } catch (Exception $ex) {
	        	echo "Erro ao Carregar: ".$ex->getMessage(); 
	        }
		}
		
		function edit($id, $nome, $login, $senha){
			$this->data->setId($id);
			$this->data->setNome($nome);
			$this->data->setLogin($login);
			$this->data->setSenha($senha);

			$sql = "UPDATE usuario SET nome = :nome, login = :login, senha = :senha WHERE id = :id";

			$d = $this->connection->connect();

			$data = $d->prepare($sql);
			$data->bindValue(":id", $this->data->getId());
			$data->bindValue(":nome", $this->data->getNome());
			$data->bindValue(":login", $this->data->getLogin());
			$data->bindValue(":senha", $this->data->getSenha());

			try {
				$data->execute();
				$_SESSION['usuario_editado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
			} catch (PDOException $ex) {
				echo "Erro ao editar: ".$ex->getMessage();
				$_SESSION['usuario_nao_editado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
			}
		}
		
		function delete($id){
			$this->data->setId($id);

			$sql = "DELETE FROM usuario WHERE id = :id";
	        $d = $this->connection->connect();

	        $data = $d->prepare($sql);
	        $data->bindValue(":id", $this->data->getId());

	        try {
	            $data->execute();
	            $_SESSION['usuario_apagado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
	        } catch (PDOException $ex) {
	            echo "Erro ao apagar: " . $ex->getMessage();
	            $_SESSION['cliente_nao_apagado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
	        }
	    }

	    function login($login, $senha){
	    	$this->data->setLogin($login);
	    	$this->data->setSenha($senha);

	    	$sql = "SELECT id, nome FROM usuario WHERE login = :login and senha = :senha;";

	    	$d = $this->connection->connect();
            $data = $d->prepare($sql);
            $data->bindValue(":login", $this->data->getLogin());
            $data->bindValue(":senha", $this->data->getSenha());
            $data->execute();
            
            $users = $data->fetchAll();
            
            if(count($users) <= 0){
                $_SESSION['nao_cadastrado'] = true;

                if(isset($_SESSION['error'])){
                	$_SESSION['error'] += 1;
                }else{
                	$_SESSION['error'] = 1;
                }

        		header('Location: ../index.php');
            }else{
                $user = $users[0];

                if(isset($_SESSION['error'])){
                	unset($_SESSION['error']);
                }	

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nome_user'] = $user['nome'];

                header('Location: ../pages/home.php');
            }
	    }
	}

	$acao = @$_REQUEST['acao'];
	$captcha = @$_REQUEST['captcha'];
	
	if($acao == "login" && $captcha == "true"){
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            'secret' => "6LdfStcUAAAAAPExZwG2G4M3BQ51_R2grekSuEIM",
            'response' => $_POST['token'],
        ];

        $options = array(
            'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data)
            )
          );

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        $res = json_decode($response, true);

        if($res['success'] == true) {
        	$obj_usuario = new Usuario_Control();
			$login = $_POST['user'];
			$senha = $_POST['senha'];

			$obj_usuario->login($login, $senha);
        } else {
        	$_SESSION['robo'] = true;
        	header('Location: ../index.php');
        }
	}else if($acao == "login"){
		$obj_usuario = new Usuario_Control();
		$login = $_POST['user'];
		$senha = $_POST['senha'];

		echo $login."<br>";
		echo $senha;
		$obj_usuario->login($login, $senha);
	}


?>