<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

	class HomeAction extends CommonAction {
        public $error = false;
        public $users = [];

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MODERATOR);
		}

		protected function executeAction() {
            $this->users = UserDAO::getUsers($_SESSION["username"]);

            if(!empty($_POST["newpwd1"]) && !empty($_POST["newpwd2"])){
                if($_POST["newpwd1"] === $_POST["newpwd2"]){
                    UserDAO::updatePassword($_SESSION["username"], $_POST["newpwd1"]);
                    unset($_POST["newpwd1"]);
                    unset($_POST["newpwd2"]);
                }
                else{
                    $this->error = true;
                }
            }

            if(!empty($_POST["newuser"]) && !empty($_POST["newuserpwd"]) && !empty($_POST["role"])){
                $visibility = 0;
                if($_POST["role"] === "mod"){
                    $visibility = 2;
                }
                if($_POST["role"] === "admin"){
                    $visibility = 3;
                }
                UserDAO::addUser($_POST["newuser"], $_POST["newuserpwd"], $visibility);
                unset($_POST["newuser"]);
                unset($_POST["newuserpwd"]);
                unset($_POST["role"]);
                header("location:home.php");
				exit;
            }

            if(!empty($_POST["deleteuser"])){
                UserDAO::deleteUser($_POST["deleteuser"]);
                unset($_POST["deleteuser"]);
                header("location:home.php");
				exit;
            }
        }
	}