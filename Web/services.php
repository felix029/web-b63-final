<?php
	require_once("action/ServicesAction.php");

	$action = new ServicesAction();
	$action->execute();

	require_once("partial/header.php");
?>
</div>

<div id="reservation">
	<h1>Réservations</h1>
	<div>
		Pour faire une réservation, contactez nous par téléphone au 007-373-5963 ou en faisant une demande en remplissant le formulaire ci-dessous. 
	</div>
	<div>
		Nous vous répondrons dans les plus brefs délais afin de confirmer la réservation.
	</div>
	<form action="services.php" method="POST">
		<label>Nom complet</label>
		<input type="text" name="fullname">
		<label>| Téléphone</label>
		<input type="tel" name="tel">
		<label>| Courriel</label>
		<input type="email" name="email">
		<label>| Nombres de personnes</label>
		<input type="number" name="nb">
		<label>| Date</label>
		<input type="date" name="date">
		<label>| Heure</label>
		<input type="time" name="time">
		<label>|</label>
		<input type="submit" value="envoyer" name="reservation" id="btn-res">
	</form>
<!-- </div> -->
<!-- La balise du div reservation sera fermée dans le footer -->
<!-- parce que j'ai dû l'ajouter après le div du header #content qui est normalement fermé -->
<!-- dans le footer. -->

<?php
	require_once("partial/footer.php");