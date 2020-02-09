<?php 
	class Cliente_Model{
		private $id;
		private $nome;
		private $email;
		private $endereco;
		private $numero_endereco;
		private $bairro;
		private $cidade;
		private $cep;
		private $estado;
		private $cpf;
		private $telefone;
		private $site;

		function __construct(){
			$this->id = 0;
			$this->nome = "";
			$this->email = "";
			$this->endereco = "";
			$this->numero_endereco = 0;
			$this->bairro = "";
			$this->cidade = "";
			$this->cep = "";
			$this->estado = "";
			$this->cpf = "";
			$this->telefone = "";
			$this->site = "";
		}

		public function getId(){
		    return $this->id;
		}
		public function setId($id){
		    return $this->id = $id;
		}

		public function getNome(){
		    return $this->nome;
		}
		public function setNome($nome){
		    return $this->nome = $nome;
		}

		public function getEmail(){
		    return $this->email;
		}
		public function setEmail($email){
		    return $this->email = $email;
		}

		public function getEndereco(){
		    return $this->endereco;
		}
		public function setEndereco($endereco){
		    return $this->endereco = $endereco;
		}

		public function getNumeroEndereco(){
		    return $this->numero_endereco;
		}
		public function setNumeroEndereco($numero_endereco){
		    return $this->numero_endereco = $numero_endereco;
		}

		public function getBairro(){
		    return $this->bairro;
		}
		public function setBairro($bairro){
		    return $this->bairro = $bairro;
		}

		public function getCidade(){
		    return $this->cidade;
		}
		public function setCidade($cidade){
		    return $this->cidade = $cidade;
		}

		public function getCep(){
		    return $this->cep;
		}
		public function setCep($cep){
		    return $this->cep = $cep;
		}

		public function getEstado(){
		    return $this->estado;
		}
		public function setEstado($estado){
		    return $this->estado = $estado;
		}

		public function getCpf(){
		    return $this->cpf;
		}
		public function setCpf($cpf){
		    return $this->cpf = $cpf;
		}

		public function getTelefone(){
		    return $this->telefone;
		}
		public function setTelefone($telefone){
		    return $this->telefone = $telefone;
		}

		public function getSite(){
		    return $this->site;
		}
		public function setSite($site){
		    return $this->site = $site;
		}
	}
?>