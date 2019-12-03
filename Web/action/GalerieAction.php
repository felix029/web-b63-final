<?php
	require_once("action/CommonAction.php");

	class GalerieAction extends CommonAction {
		public $photos = [];

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "galerie.php";

			$this->photos = UserDAO::getGalleryImg();
		}
	}