<?php
	require_once("action/ContactAction.php");

	$action = new ContactAction();
	$action->execute();

	require_once("partial/header.php");
?>

<div id="container-contact">

	<div id="location">
		<h1>Où nous trouver?</h1>
		<div>
			Situez en bord de mer en banlieu de la ville nord-côtière de Sept-Îles, DKoncept saura vous charmez, venez y faire un tour!
		</div>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2553.6128181553086!2d-66.2944628839271!3d50.20576777944228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4c91df2c32c32377%3A0x8cd256081bd21433!2s658%20Rue%20des%20Galets%2C%20Sept-%C3%8Eles%2C%20QC%20G4R%200B9!5e0!3m2!1sfr!2sca!4v1575156049525!5m2!1sfr!2sca" width="100%" height="70%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
	</div>

	<div id="contact">
		<h1>Contactez-nous</h1>
		<div>
			Pour toute informations ou commentaire, n'hésitez pas à nous contacter. Il nous fera plaisir de vous répondre dans les plus brefs délais.
		</div>
		<form action="contact.php" method="POST">
			<label>Prénom</label>
			<input type="text" name="prenom" id="" placeholder="Entrez votre prénom...">
			<label>Nom</label>
			<input type="text" name="nom" id="" placeholder="Entrez votre nom...">
			<label>Courriel</label>
			<input type="email" name="courriel" id="" placeholder="Entrez votre courriel...">
			<textarea name="message" id="message" cols="30" rows="15" placeholder="Votre message ici..."></textarea>
			<button class="button">envoyer</button>
		</form>
	</div>

</div>

<?php
	require_once("partial/footer.php");