<?php
	require_once("action/RestoAction.php");

	$action = new RestoAction();
	$action->execute();

	require_once("partial/header.php");
?>



<?php
	require_once("partial/footer.php");