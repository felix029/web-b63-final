<?php
	require_once("action/HomeAction.php");

	$action = new HomeAction();
	$action->execute();

	require_once("partial/header.php");
?>

<div id="change-pwd">
	<form action="home.php" method="post">
		<h1>changer votre mot de passe</h1>
		<label>Nouveau mot de passe:</label>
		<input type="password" name="newpwd1" />
		<label>Entrez le de nouveau:</label>
		<input type="password" name="newpwd2">
		<button>Confirmer</button>
	</form>
</div>

<?php
if($action->isAdmin()){
	?>
		<div id="add-user">
			<form action="home.php" method="post">
				<h1>ajouter un utilisateur</h1>
				<label>Nom d'utilisateur:</label>
				<input type="text" name="newuser" />
				<label>Mot de passe:</label>
				<input type="password" name="newuserpwd">
				<label>Rôle:</label>
				<div>
					<input type="radio" name="role" value="mod">Modérateur
				</div>
				<div>
					<input type="radio" name="role" value="admin">Administrateur
				</div>
				<button>Confirmer</button>
			</form>
		</div>

		<div id="delete-user">
			<form action="home.php" method="post">
				<h1>supprimer un utilisateur</h1>
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
				<button>Confirmer</button>
			</form>
		</div>
	<?php
}

?>

<?php
	require_once("partial/footer.php");