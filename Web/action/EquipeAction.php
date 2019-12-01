<?php
	require_once("action/CommonAction.php");

	class EquipeAction extends CommonAction {
		public $jobs = [];
		public $members = [];
		public $team = [];
		public $error = "ok";

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "equipe.php";

			//fetch data from db for modifications
			$this->jobs = UserDAO::getJobs();
			$this->members = UserDAO::getTeamMembers();
			$this->team = UserDAO::getTeam();

			if((isset($_POST["newfullname"]) && $_POST["newfullname"] != "") && (isset($_POST["newjob"]) && $_POST["newjob"] != "none") && (isset($_POST["newbio"])  && $_POST["newbio"] != "")&& $_FILES["newphoto"]["size"] != 0){
				try{
					$target_dir = "/images/equipe/";
					$target_file = $target_dir . basename($_FILES["newphoto"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["newphoto"]["tmp_name"]);
					if($check !== false){
						if(!file_exists($target_file)){
							if($_FILES["newphoto"]["size"] < 500000){
								if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
									if($this->error = move_uploaded_file($_FILES["newphoto"]["tmp_name"], $target_file)){
										UserDAO::newTeamMember($_POST["newfullname"], $_POST["newjob"], $_POST["newbio"], $target_file);
										header("location:equipe.php");
										exit;
									}
									else{
										//$this->error = "UPLOAD_ERROR_NEW";
										echo $this->error;
									}
								}
								else{
									$this->error = "FILE_TYPE_BAD_NEW";
								}

							}
							else{
								$this->error = "FILE_TOO_LARGE_NEW";
							}
						}
						else{
							$this->error = "FILE_EXISTS_NEW";
						}
					}
					else{
						$this->error = "FILE_NOT_IMAGE_NEW";
					}
				}
				catch(Exception $e){
					$this->error = "ERROR_ADDING_MEMBER";
				}

				unset($_POST["newfullname"]);
				unset($_POST["newjob"]);
				unset($_POST["newbio"]);
				unset($_FILES["newphoto"]);
			}


			if(isset($_POST["editname"]) && $_POST["editname"] != "none"){
				
				try{
					if(isset($_POST["editjob"]) && $_POST["editjob"] != "none"){
						UserDAO::editMemberJob($_POST["editname"], $_POST["editjob"]);
						unset($_POST["editjob"]);
					}
					
					if(isset($_POST["editbio"])){
						UserDAO::editMemberBio($_POST["editname"], $_POST["editbio"]);
						unset($_POST["editbio"]);
					}
					
					if($_FILES["editphoto"]["size"] != 0){

						$target_dir = "images/equipe/";
						$target_file = $target_dir . basename($_FILES["editphoto"]["name"]);
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						$check = getimagesize($_FILES["editphoto"]["tmp_name"]);
						if($check !== false){
							if($_FILES["editphoto"]["size"] < 500000){
								if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
									if(file_exists($target_file)){
										unlink($target_file);
									}
									if(move_uploaded_file($_FILES["editphoto"]["tmp_name"], $target_file)){
										UserDAO::editMemberPhoto($_POST["editname"], $target_file);
									}
									else{
										$this->error = "UPLOAD_ERROR_EDIT";
									}
								}
								else{
									$this->error = "FILE_TYPE_BAD_EDIT";
								}
							}
							else{
								$this->error = "FILE_TOO_LARGE_EDIT";
							}
						}
						else{
							$this->error = "FILE_NOT_IMAGE_EDIT";
						}
					}		
					
					
					if(isset($_POST["neweditname"]) && $_POST["neweditname"] != ""){
						UserDAO::editMemberName($_POST["editname"], $_POST["neweditname"]);
						unset($_POST["editjob"]);
					}

					unset($_POST["editname"]);
					header("location:equipe.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_UPDATING_MEMBER";
				}	
			}



			if(isset($_POST["deleteteam"]) && $_POST["deleteteam"] != "none"){
				try{
					UserDAO::deleteTeamMember($_POST["deleteteam"]);
					header("location:equipe.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "EXCEPTION_DELETE";
				}
				
				unset($_POST["deleteteam"]);
			}
		}
	}