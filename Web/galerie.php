<?php
	require_once("action/GalerieAction.php");

	$action = new GalerieAction();
	$action->execute();

	require_once("partial/header.php");
?>


<a href="img/galerie/lievre.jpg">
        <img src="img/galerie/lievre.jpg">
</a>
<a href="img/galerie/poutine.jpg">
        <img src="img/galerie/poutine.jpg">
</a>
<a href="img/galerie/porc.jpg">
        <img src="img/galerie/porc.jpg">
</a>

<?php
	require_once("partial/footer.php");