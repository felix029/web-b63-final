<?php
	require_once("action/GalerieAction.php");

	$action = new GalerieAction();
	$action->execute();

	require_once("partial/header.php");
?>


<a href="images/galerie/lievre.jpg">
        <img src="images/galerie/lievre.jpg">
</a>
<a href="images/galerie/poutine.jpg">
        <img src="images/galerie/poutine.jpg">
</a>
<a href="images/galerie/porc.jpg">
        <img src="images/galerie/porc.jpg">
</a>

<?php
	require_once("partial/footer.php");