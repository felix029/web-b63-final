<?php
	require_once("action/GalerieAction.php");

	$action = new GalerieAction();
	$action->execute();

	require_once("partial/header.php");

	//Photos
	foreach($action->photos as $id => $photo){
		?>
			<a href="<?= $photo[0] ?>" data-sub-html="#caption<?= $id ?>">
				<img src="<?= $photo[0] ?>" alt="<?= $photo[1] ?>">
			</a>
		<?php
	}

	//Captions
	foreach($action->photos as $id => $photo){
		?>
			</div>
			<div id="caption<?= $id ?>" style="display:none">
				<h3><?= $photo[1] ?></h3>
				<p><?= $photo[2] ?></p>
		<?php
	}


// <!-- <a href="img/galerie/lievre.jpg">
//         <img src="img/galerie/lievre.jpg">
// </a>
// <a href="img/galerie/poutine.jpg">
//         <img src="img/galerie/poutine.jpg">
// </a>
// <a href="img/galerie/porc.jpg">
//         <img src="img/galerie/porc.jpg">
// </a> -->

	require_once("partial/footer.php");