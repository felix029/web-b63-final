<?php
	require_once("action/CommonAction.php");

	class AdminLoginAction extends CommonAction {
		public $wrongLogin = false;

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			if(isset($_POST["username"]) && isset($_POST["pwd"])){
				
			}
		}
	}