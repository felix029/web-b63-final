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
				}
			}

			return $user;
		}

		public static function updatePassword($username, $newPassword) {
			$connection = Connection::getConnection();

			$statement = $connection->prepare("UPDATE users SET pwd = ? where username = ?");
			$statement->bindParam(1, hash('sha256', $newPassword));
			$statement->bindParam(2, $username);
			$statement->execute();
		}
	}