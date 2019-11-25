<?php
	require_once("action/CommonAction.php");

	class GalerieAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = true;
			$_SESSION["page"] = "galerie.php";
		}
	}