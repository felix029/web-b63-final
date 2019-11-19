<?php
	require_once("action/IndexAction.php");

	$action = new IndexAction();
	$action->execute();

	require_once("partial/header.php");
?>

<script src="js/accueil.js"></script>

<div id="carousel">
	<div class="page1"></div>
	<div class="page2"></div>
	<div class="page3"></div>
	<div class="page4"></div>
</div>

<div id="content">
	<h1>dkoncept, bon en exquis!</h1>
</div>

<?php
	require_once("partial/footer.php");