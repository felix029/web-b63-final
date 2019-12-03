<?php
	require_once("action/GalerieAction.php");

	$action = new GalerieAction();
	$action->execute();

	require_once("partial/header.php");

	if($action->isLoggedIn() && !$action->inPreview()){
		?>
		<div id="addGalleryImg" class="admin">
		<?php
			if($action->error == "ERROR_ADDING_PHOTO"){
			?>
				<h1 class="error">Erreur lors de l'ajout</h1>
			<?php
			}
			else if($action->error == "FILE_NOT_IMAGE"){
			?>
				<h1 class="error">Le fichier n'est pas une image</h1>
			<?php
			}
			else if($action->error == "FILE_TOO_LARGE"){
			?>
				<h1 class="error">Le fichier est trop large (1000MB max.)</h1>
			<?php
			}
			else if($action->error == "FILE_TYPE_BAD"){
			?>
				<h1 class="error">Ce type d'image n'est pas pris en charge</h1>
			<?php
			}
			else if($action->error == "FILE_EXISTS"){
				?>
					<h1 class="error">Cette image existe déjà (changez le nom)</h1>
				<?php
			}
			else{
				?>
				<h1>Ajoutez une image à la galerie</h1>
				<?php
			}
		?>
			<form action="galerie.php" method="POST" enctype="multipart/form-data">
				<label>Choisir une photo</label>
				<input type="file" name="photo">
				<label>Titre</label>
				<input type="text" name="title">
				<textarea name="description" cols="30" rows="10" placeholder="Ajoutez une description à la photo..."></textarea>
				<button class="button">confirmer</button>
			</form>
		</div>

		<div id="deleteGalleryImg" class="admin">
			<?php
			if($action->error == "ERROR_DELETING"){
				?>
					<h1 class="error">Erreur lors de la suppression</h1>
				<?php
			}
			else{
				?>
					<h1>Supprimer une photo</h1>
				<?php
			}
			?>
			<form action="galerie.php" method="post">
				<select name="delete-photo">
					<option value="none" selected>Choisir une photo...</option>
					<?php
					foreach($action->photos as $id => $photo){
						?>
							<option value="<?= $photo[0] ?>"><?= $id . " - " . $photo[1] ?></option>
						<?php
					}
					?>
				</select>
				<button class="button">confirmer</button>
			</form>
		</div>
		<?php
	}
	else{
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
	}

	require_once("partial/footer.php");