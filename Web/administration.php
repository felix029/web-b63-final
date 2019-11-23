<?php
	require_once("action/AdministrationAction.php");

	$action = new AdministrationAction();
	$action->execute();

	require_once("partial/header.php");
?>



<?php
	require_once("partial/footer.php");