<?php

	class Connection {
		private static $connection = null;

		public static function getConnection() {
			if (Connection::$connection == null) {
				Connection::$connection = new PDO(DSN, DB_USER, DB_PASS);
				Connection::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				Connection::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}

			return Connection::$connection;
		}

	}