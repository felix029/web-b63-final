<?php
	require_once("action/CommonAction.php");

	class ServicesAction extends CommonAction {
		public $error = "ok";

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = true;
			$_SESSION["page"] = "services.php";

			if(isset($_POST['reservation']) && $_POST['type'] != "none"){
				$subject = $_POST['type'] . " reservation on DKoncept.com";
				$headers = "From: " . $_POST['fullname'] . " <" . DK_MAIL .">\r\n";
				$headers .= "Reply-To: " . $_POST['email'] . "\r\n";
				$message =  $_POST['type'] . " reservation request from " . $_POST['fullname'] . "\n\n";
				$message .= "Email: " . $_POST['email'] . "\n";
				$message .= "Phone number: " . $_POST['tel'] . "\n";
				$message .= "For: " . $_POST['nb'] . " persons\n";
				$message .= "Date: ". $_POST['date'] . "\n";
				$message .= "Time: " . $_POST['time'] . "\n";

				$this->error = @mail(DK_MAIL, $subject, $message, $headers)?"ok":"MAIL_ERROR";

				unset($_POST['type']);
				unset($_POST['fullname']);
				unset($_POST['tel']);
				unset($_POST['email']);
				unset($_POST['nb']);
				unset($_POST['date']);
				unset($_POST['time']);
			}
		}
	}