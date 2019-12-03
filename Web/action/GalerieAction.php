<?php
	require_once("action/CommonAction.php");

	class GalerieAction extends CommonAction {
		public $error = "ok";
		public $photos = [];

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$_SESSION["editable"] = false;
			$_SESSION["page"] = "galerie.php";

			$this->photos = UserDAO::getGallery();

			if( $_FILES["photo"]["size"] != 0 && isset($_POST["title"]) && isset($_POST["description"]) ){
				try{
					$target_dir = "img/galerie/";
					$target_file = $target_dir . basename($_FILES["photo"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["photo"]["tmp_name"]);
					if($check !== false){
						if(!file_exists($target_file)){
							if($_FILES["photo"]["size"] < 1000000){
								if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
									if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
										UserDAO::addGalleryImg($target_file, $_POST['title'], $_POST['description']);
										header("location:galerie.php");
										exit;
									}
									else{
										$this->error = "ERROR_ADDING_PHOTO";
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
					$this->error = "ERROR_ADDING_PHOTO";
				}

				unset($_FILES["photo"]);
				unset($_POST["title"]);
				unset($_POST["description"]);
			}

			if(isset($_POST['delete-photo']) && $_POST['delete-photo'] != "none" && isset($_POST['delete'])){
				try{
					UserDAO::deleteGalleryImg($_POST['delete-photo']);
					header("location:galerie.php");
					exit;
				}
				catch(Exception $e){
					$this->error = "ERROR_DELETING";
				}

				unset($_POST['delete-photo']);
				unset($_POST['delete']);
			}
		}
	}