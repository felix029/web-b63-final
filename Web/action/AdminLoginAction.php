<?php
	require_once("action/CommonAction.php");

	class AdminLoginAction extends CommonAction {
		public $wrongLogin = false;

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "admin-login.php";

			if(isset($_POST["username"]) && isset($_POST["pwd"])){
				$user = UserDAO::authenticate($_POST["username"], $_POST["pwd"]);

				if(!empty($user)){
					$_SESSION["username"] = $user["USERNAME"];
					$_SESSION["visibility"] = $user["VISIBILITY"];

					header("location:home.php");
					exit;
				}
				else{
					$this->wrongLogin = true;
				}
			}
		}
	}