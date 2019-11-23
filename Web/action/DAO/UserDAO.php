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
	}