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
			$this->offers = UserDAO::getOffers();

			// add job title
			if(isset($_POST['newjob'])){
				try{
					UserDAO::addJob($_POST['newjob']);
					unset($_POST['newjob']);
					header("location:carrieres.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_ADDING_JOB";
				}
			}

			//delete job title
			if(isset($_POST['delete-job']) && $_POST['delete-job'] != "none"){
				try{
					UserDAO::deleteJob($_POST['delete-job']);
					unset($_POST['delete-job']);
					header("location:carrieres.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_DELETING_JOB";
				}
			}

			//add job offer
			if(isset($_POST['new-offer-title']) && $_POST['new-offer-title'] != "none" && isset($_POST['new-offer-salary']) && isset($_POST['new-offer-desc'])){
				try{
					UserDAO::addJobOffer($_POST['new-offer-title'], $_POST['new-offer-salary'], $_POST['new-offer-desc']);
					unset($_POST['new-offer-title']);
					unset($_POST['new-offer-salary']);
					unset($_POST['new-offer-desc']);
					header("location:carrieres.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_ADDING_OFFER";
				}
			}

			//edit job offer
			if(isset($_POST['edit-offer-title']) && $_POST['edit-offer-title'] != "none" && isset($_POST['edit-offer-salary']) && isset($_POST['edit-offer-desc'])){
				try{

					UserDAO::editJobOffer(intval($_POST['edit-offer-title']), $_POST['edit-offer-salary'], $_POST['edit-offer-desc']);
					unset($_POST['edit-offer-title']);
					unset($_POST['edit-offer-salary']);
					unset($_POST['edit-offer-desc']);
					header("location:carrieres.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_EDIT_OFFER";
				}
			}

			//delete job offer
			if(isset($_POST['delete-offer-title']) && $_POST['delete-offer-title'] != "none"){
				try{
					UserDAO::deleteJobOffer(intval($_POST['delete-offer-title']));
					unset($_POST['delete-offer-title']);
					header("location:carrieres.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_DELETING_OFFER";
				}
			}

			//apply to job offer
			if(isset($_POST['apply'])){

				//How to send a mail attachment via PHP found here: https://www.codexworld.com/send-email-with-attachment-php/
				$file = $_FILES["apply-cv"]["name"];
				$fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
				
				if($fileType == "doc" || $fileType == "docx" || $fileType == "pdf"){
					$to = "felixo2997@gmail.com";
				
					$from = $_POST['apply-email'];
					$fromName = $_POST['apply-prenom'] . " " . $_POST['apply-nom'];

					$subject = "Quelqu'un vous a envoyer une application";


					$htmlContent = "<h1>Application d'emploir pour DKoncept</h1>
									<p>Cette application a été envoyé à partir du site de DKoncept.</p>
									<p>" . $fromName ." </p>
									<p> Courriel: " . $_POST['apply-email'] . "</p>
									<p> Téléphone: " . $_POST['apply-tel'] . "</p>
									<p> ID de l'offre d'emploi: " . $_POST['apply-id'] . "</p>
									<p> Message supplémentaire: " . $_POST['apply-supp'] . "</p>";

					$headers = "From: $fromName"." <".$from.">";

					$semi_rand = md5(time()); 
					$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

					$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

					$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
					"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

					
					if(!empty($file) > 0){
						if(is_file($file)){
							$message .= "--{$mime_boundary}\n";
							$fp =    @fopen($file,"rb");
							$data =  @fread($fp,filesize($file));
					
							@fclose($fp);
							$data = chunk_split(base64_encode($data));
							$message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
							"Content-Description: ".basename($file)."\n" .
							"Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
							"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
						}
					}
					
					$message .= "--{$mime_boundary}--";
					$returnpath = "-f" . $from;

					$mail = @mail($to, $subject, $message, $headers, $returnpath);

					$this->error = $mail?"ok":"MAIL_ERROR";
				}
				else{
					$this->error = "WRONG_FILE_TYPE";
				}	
				
				unset($_POST['apply']);
			}

		}
	}
