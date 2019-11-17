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
				if (password_verify($password, $row["PASSWORD"])) {
					$user = [];
					$user["USERNAME"] = $row["FIRST_NAME"];
					$user["VISIBILITY"] = $row["VISIBILITY"];
				}
			}

			return $user;
		}

		public static function updatePassword($username, $newPassword) {
			$connection = Connection::getConnection();

			$statement = $connection->prepare("UPDATE users SET password = ? where username = ?");
			$statement->bindParam(1, $newPassword);
			$statement->bindParam(2, $username);
			$statement->execute();
		}
	}