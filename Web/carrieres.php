<?php
	require_once("action/CarrieresAction.php");

	$action = new CarrieresAction();
	$action->execute();

	require_once("partial/header.php");
?>


<?php
	require_once("partial/footer.php");
	