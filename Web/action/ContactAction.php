<?php
	require_once("action/CommonAction.php");

	class ContactAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = true;
		}
	}