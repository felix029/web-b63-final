<?php
	require_once("action/EquipeAction.php");

	$action = new EquipeAction();
	$action->execute();

	require_once("partial/header.php");

?>
	
<?php
    
	if($action->isLoggedIn()){
		?>
			<script src="js/teamEdit.js"></script>
			<div id="admin-team-container">
				<!-- Add team member -->
				<form action="equipe.php" method="POST" enctype="multipart/form-data">
					<div id="new-team-member">
						<h1>ajouter un membre à l'équipe</h1>
						
						<label>Nom complet:</label>
						<input type="text" name="newfullname" />
						
						<label>Poste:</label>
						<select name="newjob">
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
						<textarea name="newbio" cols="80" rows="8"></textarea>
						
						<label>Image:</label>
						<input type="file" name="newphoto">
						
						<button class="button">confirmer</button>
					</div>
				</form>

				<!-- Edit team member -->
				<form action="equipe.php" method="POST" enctype="multipart/form-data">
					<div id="edit-team-member">
						<h1>modifier un membre de l'équipe</h1>
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
							<h1>supprimer un membre de l'équipe</h1>
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
			</div>
		<?php
	}
	else{
		?>
			<div id=container-team>
		<?php 
		$team = UserDAO::getTeam();
    	foreach($team as $key => $value){
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