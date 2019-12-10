<?php
	require_once("action/ErrorAction.php");

	$action = new ErrorAction();
	$action->execute();

	require_once("partial/header.php");
?>

	<h1>
		<?php
			if ($_GET["code"] == 403) {
				?>
				Accès refusé
				<?php
			}
			else if ($_GET["code"] == 404) {
				?>
				La page que vous tentez d'accéder n'a pas été trouvée
				<?php
			}
			else if ($_GET["code"] == 500) {
				?>
				Erreur interne
				<?php
			}
		?>
	</h1>

<?php
	require_once("partial/footer.php");