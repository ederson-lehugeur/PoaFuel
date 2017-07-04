<?php
	class MySql {
		private $host = "127.0.0.1:3306";
		private $username = "root";
		private $password = "";
		private $database = "poafuel";
		private $connection;
		private $db_selected;
		private $result;
		
		public function getResult() {
			return $this->result;
		}
		
		public function getConnection() {
			return $this->connection;
		}
		
		public function connect() {
			$this->connection = mysql_connect($this->host, $this->username, $this->password);
			if (!$this->connection) {
				die('Erro na conexão MySQL.' . mysql_error());
			}
			$this->db_selected = mysql_select_db($this->database, $this->connection);
			if (!$this->db_selected) {
				die('Erro em selecionar o banco.' . mysql_error());
			}
		}
		
		public function executeQuery($query) {
			$this->result = mysql_query($query);
			if (!$this->result) {
				die('Erro na execução da query. ' . mysql_error());
			}
		}
		
		public function disconnect() {
			mysql_close($this->connection);
		}
	}
?>