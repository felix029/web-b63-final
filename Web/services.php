<?php
	require_once("action/ServicesAction.php");

	$action = new ServicesAction();
	$action->execute();

	require_once("partial/header.php");
?>
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
		<div>
			<label>Type</label>
			<select name="type">
				<option value="none" selected>Sélectionnez...</option>
				<option value="Table">Table</option>
				<option value="Salle">Salle</option>
				<option value="Traiteur">Traiteur</option>
			</select>
		</div>
		<div>
			<label>| Nom complet</label>
			<input type="text" name="fullname">
		</div>
		<div>
			<label>| Téléphone</label>
			<input type="tel" name="tel">
		</div>
		<div>
			<label>| Courriel</label>
			<input type="email" name="email">
		</div>
		<div>
			<label>| Nombre de personnes</label>
			<input type="number" name="nb">
		</div>
		<div>
			<label>| Date</label>
			<input type="date" name="date">
		</div>
		<div>
			<label>| Heure</label>
			<input type="time" name="time">
		</div>
		<div>
			<label>|</label>
			<input type="submit" value="envoyer" name="reservation" id="btn-res">
		</div>
	</form>
<!-- </div> -->
<!-- La balise du div reservation sera fermée dans le footer -->
<!-- parce que j'ai dû l'ajouter après le div du header #content qui est normalement fermé -->
<!-- dans le footer. -->

<?php
	require_once("partial/footer.php");