<?php
	session_start();
	require_once("action/constants.php");
	require_once("action/DAO/UserDAO.php");

	abstract class CommonAction {
		protected static $VISIBILITY_PUBLIC = 0;
		protected static $VISIBILITY_PREVIEW = 1;
		protected static $VISIBILITY_MODERATOR = 2;
		protected static $VISIBILITY_ADMIN = 3;

		private $pageVisibility;

		public function __construct($pageVisibility) {
			$this->pageVisibility = $pageVisibility;
		}

		public function execute() {

			if (!empty($_GET["logout"])) {
				session_unset();
				session_destroy();
				session_start();
			}

			if(isset($_GET["preview"])){
				if($_GET["preview"] == "true"){
					$_SESSION["temp_vis"] = $_SESSION["visibility"];
					$_SESSION["visibility"] = CommonAction::$VISIBILITY_PREVIEW;
				}
				if($_GET["preview"] == "false"){
					$_SESSION["visibility"] = $_SESSION["temp_vis"];
					unset($_SESSION["temp_vis"]);
				}
			}

			if (empty($_SESSION["visibility"])) {
				$_SESSION["visibility"] = CommonAction::$VISIBILITY_PUBLIC;
			}

			if ($_SESSION["visibility"] < $this->pageVisibility) {
				header("location:index.php");
				exit;
			}

			// Template method
			$this->executeAction();

			//Updating editable pages
			if (isset($_POST["content"]) && $_SESSION["editable"] == true){

				UserDAO::setPageContent($_SESSION["page"], $_POST["content"]);
				unset($_POST["content"]);
			}
		}

		protected abstract function executeAction();

		public function isLoggedIn() {
			return $_SESSION["visibility"] > CommonAction::$VISIBILITY_PUBLIC;
		}

		public function inPreview() {
			return $_SESSION["visibility"] === CommonAction::$VISIBILITY_PREVIEW;
		}

		public function isAdmin() {
			return $_SESSION["visibility"] === CommonAction::$VISIBILITY_ADMIN;
		}

		public function getUsername() {
			return empty($_SESSION["username"]) ? "Invité" : $_SESSION["username"];
		}
	}