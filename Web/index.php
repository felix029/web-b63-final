<?php
	require_once("action/IndexAction.php");

	$action = new IndexAction();
	$action->execute();

	require_once("partial/header.php");
?>

	<h1>dkoncept, bon en exquis!</h1>


<?php
	require_once("partial/footer.php");