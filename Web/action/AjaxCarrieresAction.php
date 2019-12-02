<?php
    require_once("action/CommonAction.php");

    class AjaxCarrieresAction extends CommonAction {
        public $result = "";

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function executeAction() {
            
            if(isset($_POST["id"])){
                $this->result = UserDAO::getOneOffer($_POST['id']);
            }
               
        }

    }
    