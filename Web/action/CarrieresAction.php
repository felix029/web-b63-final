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

		}
	}
