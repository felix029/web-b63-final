<?php
	require_once("action/HomeAction.php");

	$action = new HomeAction();
	$action->execute();

	require_once("partial/header.php");
?>

<div id="change-pwd">
	<form action="home.php" method="post">
		<?php
			if($action->error === "PWD_DIFFERENT"){
				?>
					<h2 class="error">Les MDP entrés sont différents.</h2>
				<?php
			}
			else{
				?>
					<h2>changer votre mot de passe</h2>
				<?php
			}
		?>
		<label>Nouveau mot de passe:</label>
		<input type="password" name="newpwd1" />
		<label>Entrez le de nouveau:</label>
		<input type="password" name="newpwd2">
		<button class="button">confirmer</button>
	</form>
</div>

<?php
if($action->isAdmin()){
	?>
		<div id="add-user">
			<form action="home.php" method="post">
				<?php
					if($action->error === "USER_UNIQUE"){
					?>
						<h2 class="error">Cet utilisateur existe déjà.</h2>
					<?php
					}
					else{
						?>
							<h2>ajouter un utilisateur</h2>
						<?php
					}
				?>
				<label>Nom d'utilisateur:</label>
				<input type="text" name="newuser" />
				<label>Mot de passe:</label>
				<input type="password" name="newuserpwd">
				<label>Rôle:</label>
				<div>
					<input type="radio" name="role" value="mod"> Modérateur
				</div>
				<div>
					<input type="radio" name="role" value="admin"> Administrateur
				</div>
				<button class="button">confirmer</button>
			</form>
		</div>

		<div id="delete-user">
			<form action="home.php" method="post">
				<?php
					if($action->error === "DELETE_PROBLEM"){
					?>
						<h2 class="error">Une erreur est survenue</h2>
					<?php
					}
					else{
					?>
						<h2>supprimer un utilisateur</h2>
					<?php
					}
				?>
				<label>Nom d'utilisateur:</label>
				<select name="deleteuser">
				<?php
					foreach($action->users as $u){
						?>
							<option value="<?= $u ?>"><?= $u ?></option>
						<?php
					}
				?>
				</select>
				<button class="button">confirmer</button>
			</form>
		</div>
	<?php
}

?>

<?php
	require_once("partial/footer.php");