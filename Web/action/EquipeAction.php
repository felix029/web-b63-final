<?php
	require_once("action/CommonAction.php");

	class EquipeAction extends CommonAction {
		public $jobs = [];
		public $members = [];
		public $error = "ok";

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "equipe.php";

			$this->jobs = UserDAO::getJobs();
			$this->members = UserDAO::getTeamMembers();


			if(isset($_POST["newfullname"]) && isset($_POST["newjob"]) && isset($_POST["newbio"]) && isset($_POST["newphoto"])){
				$this->error = "here bitch";
				try{
					$target_dir = "images/equipe/";
					$target_file = $target_dir . basename($_FILES["newphoto"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["newphoto"]["tmp_name"]);
					if($check !== false){
						if(!file_exists($target_file)){
							if($_FILES["newphoto"]["size"] < 500000){
								if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
									if(move_uploaded_file($_FILES["newphoto"], $target_file)){
										UserDAO::newTeamMember($_POST["newfullname"], $_POST["newjob"], $_POST["newbio"], $target_file);
									}
									else{
										$this->error = "UPLOAD_ERROR";
									}
								}
								else{
									$this->error = "FILE_TYPE_BAD";
								}

							}
							else{
								$this->error = "FILE_TOO_LARGE";
							}
						}
						else{
							$this->error = "FILE_EXISTS";
						}
					}
					else{
						$this->error = "FILE_NOT_IMAGE";
					}
				}
				catch(Exception $e){
					$this->error = "WTF";
				}
			}
		}
	}