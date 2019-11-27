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
        }

    }
    