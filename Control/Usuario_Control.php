<?php 
	session_start();
	include '../../Model/Usuario_Model.php';
	include '../../DB/Conexao.php';

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

			$sql = "SELECT COUNT(*) FROM usuario WHERE login = :login";
		    $d = $this->connection->connect();
		    $dados = $d->prepare($sql);
		    $dados->bindValue(":login", $this->data->getLogin());

		    try {
		    	$dados->execute();

			    $user = $dados->fetchColumn();

			    if($user == 0){
			    	$sql = "INSERT INTO usuario (nome, login, senha) VALUES (:nome, :login, :senha);";

					$d = $this->connection->connect();

					$data = $d->prepare($sql);
					$data->bindValue(":nome", $this->data->getNome());
					$data->bindValue(":login", $this->data->getLogin());
					$data->bindValue(":senha", $this->data->getSenha());

					try {
						$data->execute();
						$_SESSION['usuario_cadastrado'] = true;
						echo "<script>window.location.href = 'home_users.php';</script>";
					} catch (PDOException $ex) {
						echo "Erro ao cadastrar: ".$ex->getMessage();
						$_SESSION['usuario_nao_cadastrado'] = true;
						echo "<script>window.location.href = 'home_users.php';</script>";
					}
			    }else{
			    	$_SESSION['ja_cadastrado'] = true;
			    }
		    } catch (PDOException $ex) {
		    	echo "Erro ao cadastrar: ".$ex->getMessage();
				$_SESSION['usuario_nao_cadastrado'] = true;
				echo "<script>window.location.href = 'home_users.php';</script>";
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
				echo "<script>window.location.href = 'home_users.php';</script>";
			} catch (PDOException $ex) {
				echo "Erro ao editar: ".$ex->getMessage();
				$_SESSION['usuario_nao_editado'] = true;
				echo "<script>window.location.href = 'home_users.php';</script>";
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
				echo "<script>window.location.href = 'home_users.php';</script>";
	        } catch (PDOException $ex) {
	            echo "Erro ao apagar: " . $ex->getMessage();
	            $_SESSION['usuario_nao_apagado'] = true;
				echo "<script>window.location.href = 'home_users.php';</script>";
	        }
	    }	
	}
?>