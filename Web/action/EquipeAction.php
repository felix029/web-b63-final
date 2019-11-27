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


			if(isset($_POST["newfullname"]) && isset($_POST["newjob"]) && isset($_POST["newbio"]) && isset($_FILES["newphoto"])){
				try{
					$target_dir = "images/equipe/";
					$target_file = $target_dir . basename($_FILES["newphoto"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["newphoto"]["tmp_name"]);
					if($check !== false){
						if(!file_exists($target_file)){
							if($_FILES["newphoto"]["size"] < 500000){
								if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
									if(move_uploaded_file($_FILES["newphoto"]["tmp_name"], $target_file)){
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
					$this->error = "EXCEPTION_NEW_MEMBER";
				}

			unset($_POST["newfullname"]);
			unset($_POST["newjob"]);
			unset($_POST["newbio"]);
			unset($_FILES["newphoto"]);

			}

			if(isset($_POST["deleteteam"])){
				try{
					UserDAO::deleteTeamMember($_POST["deleteteam"]);
				}
				catch(Exception $e){
					$this->error = "EXCEPTION_DELETE";
				}
				
				unset($_POST["deleteteam"]);
			}
		}
	}