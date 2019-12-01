<?php
	require_once("action/CarrieresAction.php");

	$action = new CarrieresAction();
	$action->execute();

	require_once("partial/header.php");
	
	if($action->isLoggedIn() && !$action->inPreview()){
	?>
		<script src="js/jobsEdit.js"></script>
		<div id="admin-jobs-container">
			
			<div id="add-job-title">
				<form action="carrieres.php" method="POST">
					<?php
						if($action->error == "ERROR_ADDING_JOB"){
							?>
								<h1 class="error">Erreur lors de l'ajout de l'emploi</h1>
							<?php
						}
						else{
							?>
								<h1>Ajoutez un emploi</h1>
							<?php
						}
					?>
					<label>Titre de l'emploi</label>
					<input type="text" name="newjob">
					<button class="button">confirmer</button>
				</form>
			</div>

			<div id="delete-job-title">
				<form action="carrieres.php" method="POST">
					<?php
						if($action->error == "ERROR_DELETING_JOB"){
							?>
								<h1 class="error">Erreur lors de la supression de l'emploi</h1>
							<?php
						}
						else{
							?>
								<h1>Supprimer un emploi</h1>
							<?php
						}
					?>
					<select name="delete-job">
						<option value="none" selected>Sélectionnez un titre...</option>
						<?php
							foreach($action->jobs as $j){
								?>
									<option value="<?= $j ?>"><?= $j ?></option>
								<?php
							}
						?>
					</select>
					<button class="button">confirmer</button>
				</form>
			</div>

			<div id="add-job-offer">
				<form action="carrieres.php" method="POST">
				<?php
					if($action->error == "ERROR_ADDING_OFFER"){
						?>
							<h1 class="error">Erreur lors de l'ajout de l'offre</h1>
						<?php
					}
					else{
						?>
							<h1>Ajouter une offre d'emploi</h1>
						<?php
					}
				?>
				<label>Titre de l'emploi</label>
				<select name="new-offer-title">
					<option value="none" selected>Selectionnez un titre...</option>
					<?php
						foreach($action->jobs as $j){
							?>
								<option value="<?= $j ?>"><?= $j ?></option>
							<?php
						}
					?>
				</select>
				<label>Salaire horraire offert</label>
				<input type="text" name="new-offer-salary">
				<textarea name="new-offer-desc" id="" cols="30" rows="10" placeholder="Décrivez brièvements les responsabilités/taches du poste..."></textarea>
				<button class="button">confirmer</button>	
			</form>
			</div>

			<div id="edit-job-offer">
				<form action="carrieres.php" method="POST">
				<?php
						if($action->error == "ERROR_DELTING_JOB"){
							?>
								<h1 class="error">Erreur lors de la modification de l'offre</h1>
							<?php
						}
						else{
							?>
								<h1>Modifier une offre d'emploi</h1>
							<?php
						}
					?>
				<label>Offre à modifier</label>
				<select name="edit-offer-title">
					<option value="none" selected>Sélectionnez une offre...</option>
					<?php
						foreach($action->offers as $key => $offer){
							?>
								<option value="<?= $key ?>"><?= $key . " - " . $offer["title"] ?></option>
							<?php
						}
					?>
				</select>
				<label>Salaire horraire offert</label>
				<input type="text" name="edit-offer-salary">
				<textarea name="edit-offer-desc" id="" cols="30" rows="10" placeholder="Décrivez brièvements les responsabilités/taches du poste..."></textarea>
				<button class="button">confirmer</button>
				</form>
			</div>

			<div id="delete-job-offer">
				<form action="carrieres.php" method="POST">
				<?php
						if($action->error == "ERROR_DELTING_JOB"){
							?>
								<h1 class="error">Erreur lors de la supression de l'offre</h1>
							<?php
						}
						else{
							?>
								<h1>Supprimer une offre d'emploi</h1>
							<?php
						}
					?>
				<select name="delete-offer-title">
					<option value="none" selected>Sélectionnez une offre...</option>
					<?php
						foreach($action->offers as $key => $offer){
							?>
								<option value="<?= $key ?>"><?= $key . " - " . $offer["title"] ?></option>
							<?php
						}
					?>
				</select>
				<button class="button">confirmer</button>
				</form>
			</div>


		</div>
	<?php
	}
	else{
		?>

	<?php
	}

	require_once("partial/footer.php");
	