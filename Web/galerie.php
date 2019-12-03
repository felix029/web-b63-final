<?php
	require_once("action/GalerieAction.php");

	$action = new GalerieAction();
	$action->execute();

	require_once("partial/header.php");
?>


<a href="images/lievre.jpg">
        <img src="img/lievre.jpg">
</a>
<a href="img/poutine.jpg">
        <img src="img/poutine.jpg">
</a>

<?php
	require_once("partial/footer.php");