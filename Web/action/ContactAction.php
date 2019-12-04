<?php
	require_once("action/CommonAction.php");

	class ContactAction extends CommonAction {
		public $error = "ok";
		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "contact.php";

			if(!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['courriel']) && !empty($_POST['message'])){
				$subject = "Message from DKoncept.com";
				$headers = "From: " . $_POST['prenom'] . " " . $_POST['nom'] . " <" . DK_MAIL .">\r\n";
				$headers .= "Reply-To: " . $_POST['courriel'] . "\r\n";
				$message = "Message from " . $_POST['prenom'] . " " . $_POST['nom'] . " (" . $_POST['courriel'] . ")\n\n";
				$message .= $_POST['message'];

				
				$this->error = @mail(DK_MAIL, $subject, $message, $headers)?"ok":"MAIL_ERROR";
				unset($_POST['prenom']);
				unset($_POST['nom']);
				unset($_POST['courriel']);
				unset($_POST['message']);
			}
			else{
				$this->error = "MISSING_FIELDS";
			}

		}
	}