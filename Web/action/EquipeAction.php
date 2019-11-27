<?php
	require_once("action/CommonAction.php");

	class EquipeAction extends CommonAction {
		public $jobs = [];
		public $members = [];

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "equipe.php";

			$this->jobs = UserDAO::getJobs();
			$this->members = UserDAO::getTeamMembers();
		}
	}