<?php
	require_once("action/CommonAction.php");

	class AdministrationAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MODERATOR);
		}

		protected function executeAction() {
			
		}
	}