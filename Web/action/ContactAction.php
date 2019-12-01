<?php
	require_once("action/CommonAction.php");

	class ContactAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "contact.php";

			if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['courriel']) && isset($_POST['message'])){
				$subject = "Message from DKoncept.com";
				$headers = "From: " . $_POST['prenom'] . " " . $_POST['nom'] . " <noreply@dkoncept.com>\r\n";
				$headers .= "Reply-To: " . $_POST['courriel'] . "\r\n";
				$message = "Message from " . $_POST['prenom'] . " " . $_POST['nom'] . " (" . $_POST['courriel'] . ")\n\n";
				$message .= $_POST['message'];

				mail("felixo2997@gmail.com", $subject, $message, $headers);

				unset($_POST['prenom']);
				unset($_POST['nom']);
				unset($_POST['courriel']);
				unset($_POST['message']);
			}

		}
	}