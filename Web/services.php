<?php
	require_once("action/ServicesAction.php");

	$action = new ServicesAction();
	$action->execute();

	require_once("partial/header.php");
?>



<?php
	require_once("partial/footer.php");