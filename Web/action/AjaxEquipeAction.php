<?php
    require_once("action/CommonAction.php");

    class AjaxEquipeAction extends CommonAction {
        public $result = "";

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function executeAction() {
            if(isset($_POST["value"])){
                $this->result = UserDAO::getBio($_POST["value"]);
                unset($_POST["value"]);
            }           
            
            if(isset($_POST["memberpos"])){
                $this->result = UserDAO::getPos($_POST["memberpos"]);
                unset($_POST["memberpos"]);
            }

            if(isset($_POST["allpos"])){
                $this->result = UserDAO::getAllPos($_POST["allpos"]);
                unset($_POST["allpos"]);
            }

            if(isset($_POST["membereditpos"]) && isset($_POST["membernewpos"])){
                // echo "<script> alert('" $_POST["membereditpos"] "+ ' ' + " $_POST["membernewpos"] "');</script>";
                UserDAO::editMemberPos($_POST["membereditpos"], $_POST["membernewpos"]);
                unset($_POST["membereditpos"]);
                unset($_POST["membernewpos"]);
            }
        }

    }
    