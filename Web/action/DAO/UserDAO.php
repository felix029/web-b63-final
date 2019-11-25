<?php
	require_once("action/DAO/Connection.php");

	class UserDAO {

		public static function authenticate($username, $password) {
			$user = null;

			$connection = Connection::getConnection();

			$statement = $connection->prepare("SELECT * from users where username = ?");
			$statement->bindParam(1, $username);
			$statement->setFetchMode(PDO::FETCH_ASSOC); // row["USERNAME"]
			$statement->execute();

			if ($row = $statement->fetch()) {
				$hash = hash('sha256', $password);

				if ($hash === $row["pwd"]) {
					$user = [];
					$user["USERNAME"] = $row["username"];
					$user["VISIBILITY"] = $row["visibility"];
				}
			}

			return $user;
		}

		public static function updatePassword($username, $newPassword) {
			$connection = Connection::getConnection();
			$hash = hash('sha256', $newPassword);

			$statement = $connection->prepare("UPDATE users SET pwd = ? where username = ?");
			$statement->bindParam(1, $hash);
			$statement->bindParam(2, $username);
			$statement->execute();
		}

		public static function addUser($username, $password, $visibility) {
			$connection = Connection::getConnection();
			$hash = hash('sha256', $password);

			$statement = $connection->prepare("INSERT INTO users(username, pwd, visibility) VALUES (?, ?, ?)");
			$statement->bindParam(1, $username);
			$statement->bindParam(2, $hash);
			$statement->bindParam(3, $visibility);
			$statement->execute();
		}

		public static function deleteUser($username){
			if($username != "dkadmin"){
				$connection = Connection::getConnection();
				$statement = $connection->prepare("DELETE FROM users WHERE username = ?");
				$statement->bindParam(1, $username);
				$statement->execute();

			}
		}

		public static function getUsers($username){
			$connection = Connection::getConnection();
			$sql = "SELECT username FROM users WHERE username <> 'dkadmin'";
			$users = [];
			foreach($connection->query($sql) as $row){
				array_push($users, $row["username"]);
			}

			return $users;
		}

		public static function setPageContent($page, $content){
			$connection = Connection::getConnection();

			$statement = $connection->prepare("UPDATE pages SET content = ? where title = ?");
			$statement->bindParam(1, $content);
			$statement->bindParam(2, $page);
			$statement->execute();
		}

		public static function getPageContent($page){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT content FROM pages WHERE title = ?");
			$statement->bindParam(1, $page);
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$statement->execute();

			$result = "ERROR";

			if($row = $statement->fetch()){
				$result = $row["content"];
			}

			return $result;
		}
	}