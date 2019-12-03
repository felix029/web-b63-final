<?php
	require_once("action/ServicesAction.php");

	$action = new ServicesAction();
	$action->execute();

	require_once("partial/header.php");
?>
</div>

<div id="reservation-mobile">
	<h1>Cliquez ici pour réserver</h1>
</div>

<div id="reservation">
		<?php
		if($action->error == "MAIL_ERROR"){
			?>
			<h1 class="error">Erreur lors de la réservation</h1>
			<?php
		}
		else{
			?>
			<h1>Réservations</h1>
			<?php
		}
		?>
	<div>
		Pour faire une réservation, contactez nous par téléphone au 007-373-5963 ou en faisant une demande en remplissant le formulaire ci-dessous. 
	</div>
	<div>
		Nous vous répondrons dans les plus brefs délais afin de confirmer la réservation.
	</div>
	<form action="services.php" method="POST">
		<label>Type</label>
		<select name="type">
			<option value="none" selected>Choisir</option>
			<option value="Table">Table</option>
			<option value="Salle">Salle</option>
			<option value="Traiteur">Traiteur</option>
		</select>
		<input class="res-mobile" type="text" name="fullname" placeholder="Nom complet...">
		<input class="res-mobile" type="tel" name="tel" placeholder="Téléphone...">
		<input class="res-mobile" type="email" name="email" placeholder="Courriel...">
		<input id="nb-pers" class="res-mobile" type="number" name="nb" placeholder="Nombre de personnes...">
		<label>Date</label>
		<input type="date" name="date">
		<label>Heure</label>
		<input type="time" name="time">
		<input class="res-mobile" type="submit" value="envoyer" name="reservation" id="btn-res">
	</form>
<!-- </div> -->
<!-- La balise du div reservation sera fermée dans le footer -->
<!-- parce que j'ai dû l'ajouter après le div du header #content qui est normalement fermé -->
<!-- dans le footer. -->

<?php
	require_once("partial/footer.php");