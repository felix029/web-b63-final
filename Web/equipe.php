<?php
	require_once("action/EquipeAction.php");

	$action = new EquipeAction();
	$action->execute();

	require_once("partial/header.php");
?>



<?php
	require_once("partial/footer.php");