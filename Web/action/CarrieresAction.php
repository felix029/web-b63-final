<?php
	require_once("action/CommonAction.php");

	class CarrieresAction extends CommonAction {
		public $jobs = [];
		public $offers = [];
		public $error = "ok";

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "carrieres.php";

			$this->jobs = UserDAO::getJobs();
			//$this->offers = UserDAO::getOffers();

		}
	}
