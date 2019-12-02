<?php
	require_once("action/EquipeAction.php");

	$action = new EquipeAction();
	$action->execute();

	require_once("partial/header.php");

	if($action->isLoggedIn() && !$action->inPreview()){
	?>
			<script src="js/teamEdit.js"></script>
			<div id="admin-team-container">
				<!-- Add team member -->
				<form action="equipe.php" method="POST" enctype="multipart/form-data">
					<div id="new-team-member">
						<?php
							
							if($action->error == "ERROR_ADDING_MEMBER"){
								?>
								<h1 class="error">Erreur lors de l'ajout...</h1>
								<?php
							}
							else if($action->error == "FILE_NOT_IMAGE_NEW"){
								?>
								<h1 class="error">Le fichier n'est pas une image</h1>
								<?php
							}
							else if($action->error == "FILE_EXISTS_NEW"){
								?>
								<h1 class="error">Ce fichier existe déjà</h1>
								<?php
							}
							else if($action->error == "FILE_TOO_LARGE_NEW"){
								?>
								<h1 class="error">Le fichier est trop large (500MB max.)</h1>
								<?php
							}
							else if($action->error == "FILE_TYPE_BAD_NEW"){
								?>
								<h1 class="error">Ce type d'image n'est pas pris en charge</h1>
								<?php
							}
							else if($action->error == "UPLOAD_ERROR_NEW"){
								?>
								<h1 class="error">Erreur lors du chargement de l'image...</h1>
								<?php
							}
							else{
								?>
								<h1>ajouter un membre à l'équipe</h1>
								<?php
							}
							?>
						<label>Nom complet:</label>
						<input type="text" name="newfullname" id="newfullname"/>
						
						<label>Poste:</label>
						<select name="newjob" id="newjob">
							<option value="none" selected>Sélectionnez un poste...</option>
							<?php
								foreach($action->jobs as $j){
									?>
										<option value="<?= $j ?>"><?= $j ?></option>
									<?php
								}
							?>
						</select>
						
						<label>Biographie:</label>
						<textarea name="newbio" id="newbio" cols="80" rows="8"></textarea>
						
						<label>Image:</label>
						<input type="file" name="newphoto" id="newphoto">
						
						<button class="button" id="newmemberbtn">confirmer</button>
					</div>
				</form>

				<!-- Edit team member -->
				<form action="equipe.php" method="POST" enctype="multipart/mixed">
					<div id="edit-team-member">
						<?php
						if($action->error == "FILE_NOT_IMAGE_EDIT"){
						?>
							<h1 class="error">Le fichier n'est pas une image</h1>
						<?php
						}
						else if($action->error == "ERROR_UPDATING_MEMBER"){
						?>
							<h1 class="error">Erreur lors de la mise à jour...</h1>
						<?php
						}
						else if($action->error == "FILE_TOO_LARGE_EDIT"){
						?>
							<h1 class="error">Le fichier est trop large (500MB max.)</h1>
						<?php
						}
						else if($action->error == "FILE_TYPE_BAD_EDIT"){
						?>
							<h1 class="error">Ce type d'image n'est pas pris en charge</h1>
						<?php
						}
						else if($action->error == "UPLOAD_ERROR_EDIT"){
						?>
							<h1 class="error">Erreur lors du chargement de l'image...</h1>
						<?php
						}
						else{
							?>
								<h1>modifier un membre de l'équipe</h1>
							<?php
							}
						?>
						<label>Nom complet:</label>
						<select name="editname" id="editname">
							<option value="none" selected>Sélectionnez quelqu'un...</option>
							<?php
								foreach($action->members as $m){
									?>
										<option value="<?= $m ?>"><?= $m ?></option>
									<?php
								}
							?>
						</select>
						<label>Nouveau nom complet:</label>
						<input type="text" name="neweditname" placeholder="Laissez vide pour ne pas changer..."/>			
						<label>Nouveau poste:</label>
						<select name="editjob">
							<option value="none" selected>Ne pas changer...</option>
							<?php
								foreach($action->jobs as $j){
									?>
										<option value="<?= $j ?>"><?= $j ?></option>
									<?php
								}
							?>
						</select>
						<label>Nouvelle biographie:</label>
						<textarea name="editbio" cols="80" rows="8" id="editbio"></textarea>
						<label>Nouvelle image:</label>
						<input type="file" name="editphoto">
						<button class="button">confirmer</button>
					</div>
				</form>

				<!-- Delete team member -->
				<form action="equipe.php" method="POST">
					<div id="delete-team-member">
							<?php
							if($action->error == "EXCEPTION_DELETE"){
							?>
								<h1 class="error">Erreur lors de la supression...</h1>
							<?php
							}
							else{
							?>
								<h1>supprimer un membre de l'équipe</h1>
							<?php
							}
							?>
							<label>Nom:</label>
							<select name="deleteteam">
								<option value="none" selected>Sélectionnez quelqu'un...</option>
							<?php
								foreach($action->members as $m){
									?>
										<option value="<?= $m ?>"><?= $m ?></option>
									<?php
								}
							?>
							</select>
							<button class="button">confirmer</button>
					</div>
				</form>

				<form action="equipe.php" method="POST">
					<div id="pos-team-member">
							<?php
								if($action->error == "ERROR_CHANGING_POS"){
									?>
									<h1 class="error">Erreur lors du changement de position</h1>
									<?php
								}
								else{
									?>
									<h1>Changez la position d'une fiche</h1>
									<h2>(En ordre croissant)</h2>
									<?php
								}
							?>
							<select name="fullnamepos" id="fullnamepos">
								<option value="none" selected>Sélectionnez quelqu'un...</option>
								<?php
									foreach($action->members as $m){
										?>
											<option value="<?= $m ?>"><?= $m ?></option>
										<?php
									}
								?>
							</select>
							<select name="memberpos" id="memberpos">

							</select>
					</div>
				</form>
			</div>
		<?php
	}
	else{
		?>
			<div id=container-team>
		<?php 
    	foreach($action->team as $key => $value){
			?>
    	    	    <div class="team-member" id="team<?= $key; ?>">
						<div class="team-photo" style="background-image: url(<?= $value[3] ?>)"></div>
						<div class="team-name"><?= $value[0] ?></div>
						<div class="team-job"><?= $value[1] ?></div>
						<div class="team-bio"><?= $value[2] ?></div>
					</div>
    	    <?php
		}
		?>
			</div>
		<?php
	}

	require_once("partial/footer.php");