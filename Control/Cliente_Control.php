<?php 
	session_start();
	include '../Model/Cliente_Model.php';
	include '../DB/Conexao.php';

	class Cliente_Control {
		private $data;
		private $connection;

		function __construct(){
			$this->data = new Cliente_Model();
			$this->connection = new Conexao();
		}

		function VerClientes(){
			$sql = "SELECT * FROM cliente";
			$d = $this->connection->connect();
			$dados = $d->prepare($sql);
			$dados->execute();
			return $dados;
		}

		function create($nome, $email, $cpf, $endereco, $numero_endereco, $bairro, $cidade, $cep, $estado, $telefone, $site){
			$this->data->setNome($nome);
			$this->data->setEmail($email);
			$this->data->setCpf($cpf);
			$this->data->setEndereco($endereco);
			$this->data->setNumeroEndereco($numero_endereco);
			$this->data->setBairro($bairro);
			$this->data->setCidade($cidade);
			$this->data->setCep($cep);
			$this->data->setEstado($estado);
			$this->data->setTelefone($telefone);
			$this->data->setSite($site);

			$sql = "INSERT INTO cliente (nome, endereco, numero, bairro, cidade, uf, cep, email, cpf, telefone, site) VALUES (:nome, :endereco, :numero, :bairro, :cidade, :uf, :cep, :email, :cpf, :telefone, :site);";

			$d = $this->connection->connect();

			$data = $d->prepare($sql);
			$data->bindValue(":nome", $this->data->getNome());
			$data->bindValue(":endereco", $this->data->getEndereco());
			$data->bindValue(":numero", $this->data->getNumeroEndereco());
			$data->bindValue(":bairro", $this->data->getBairro());
			$data->bindValue(":cidade", $this->data->getCidade());
			$data->bindValue(":uf", $this->data->getEstado());
			$data->bindValue(":cep", $this->data->getCep());
			$data->bindValue(":email", $this->data->getEmail());
			$data->bindValue(":cpf", $this->data->getCpf());
			$data->bindValue(":telefone", $this->data->getTelefone());
			$data->bindValue(":site", $this->data->getSite());

			try {
				$data->execute();
				$_SESSION['cliente_cadastrado'] = true;
				echo "Cadastrado";
				// echo "<script>window.location.href = 'clientes.php';</script>";
			} catch (PDOException $ex) {
				echo "Erro ao cadastrar: ".$ex->getMessage();
				$_SESSION['cliente_nao_cadastrado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
			}
		}
		
		function read($id){
			$this->data->setId($id);

			$sql = "SELECT * FROM cliente WHERE id = :id";

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
		
		function edit($id, $nome, $email, $cpf, $endereco, $numero_endereco, $bairro, $cidade, $cep, $estado, $telefone, $site){
			$this->data->setId($id);
			$this->data->setNome($nome);
			$this->data->setEmail($email);
			$this->data->setCpf($cpf);
			$this->data->setEndereco($endereco);
			$this->data->setNumeroEndereco($numero_endereco);
			$this->data->setBairro($bairro);
			$this->data->setCidade($cidade);
			$this->data->setCep($cep);
			$this->data->setEstado($estado);
			$this->data->setTelefone($telefone);
			$this->data->setSite($site);

			$sql = "UPDATE cliente SET nome = :nome, email = :email, cpf = :cpf, endereco = :endereco, numero = :numero_endereco, bairro = :bairro, cidade = :cidade, cep = :cep, uf = :uf, telefone = :telefone, site = :site WHERE id = :id";

			$d = $this->connection->connect();

			$data = $d->prepare($sql);
			$data->bindValue(":id", $this->data->getId());
			$data->bindValue(":nome", $this->data->getNome());
			$data->bindValue(":endereco", $this->data->getEndereco());
			$data->bindValue(":numero_endereco", $this->data->getNumeroEndereco());
			$data->bindValue(":bairro", $this->data->getBairro());
			$data->bindValue(":cidade", $this->data->getCidade());
			$data->bindValue(":uf", $this->data->getEstado());
			$data->bindValue(":cep", $this->data->getCep());
			$data->bindValue(":email", $this->data->getEmail());
			$data->bindValue(":cpf", $this->data->getCpf());
			$data->bindValue(":telefone", $this->data->getTelefone());
			$data->bindValue(":site", $this->data->getSite());

			try {
				$data->execute();
				$_SESSION['cliente_editado'] = true;
				echo "editou";
				// echo "<script>window.location.href = 'clientes.php';</script>";
			} catch (PDOException $ex) {
				echo "Erro ao editar: ".$ex->getMessage();
				// $_SESSION['cliente_nao_editado'] = true;
				echo "<script>window.location.href = 'clientes.php';</script>";
			}
		}
		
		function delete($id){
			$this->data->setId($id);

			$sql = "DELETE FROM cliente WHERE id = :id";
	        $d = $this->connection->connect();

	        $data = $d->prepare($sql);
	        $data->bindValue(":id", $this->data->getId());

	        try {
	            $data->execute();
	            $_SESSION['cliente_apagado'] = true;
				echo "apagou";
				// echo "<script>window.location.href = 'clientes.php';</script>";
	        } catch (PDOException $ex) {
	            echo "Erro ao apagar: " . $ex->getMessage();
	            $_SESSION['cliente_nao_apagado'] = true;
				// echo "<script>window.location.href = 'clientes.php';</script>";
	        }
	    }
	}

	// $obj_cliente = new Cliente_Control();
	// $obj_cliente->create("Victor", "victorcsa2002@gmail.com", "111.222.333-44", "Rua Caratimbas", "18", "Rodovia", "Parnalandia", "64212150", "PB", "(85)92435-9323", "caratimpas.com.br");
	// $obj_cliente->edit("1", "Jose", "victorcsa2002@gmail.com", "111.222.333-44", "Rua Caratimbas", "18", "Rodovia", "Parnalandia", "64212150", "PB", "(85)92435-9323", "caratimpas.com.br");
	// $dados = $obj_cliente->read("1");
	// foreach ($dados as $d) {
	// 	echo $d['id'];
	// }
	// $obj_cliente->delete("1");
?>