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
				</form>
			</div>

			<div id="delete-job-title">
				<form action="carrieres.php" method="POST">
					<?php
						if($action->error == "ERROR_DELTING_JOB"){
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

				
				</form>
			</div>


		</div>
	<?php
	else{
		?>

	<?php
	}

	require_once("partial/footer.php");
	