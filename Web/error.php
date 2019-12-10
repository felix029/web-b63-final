<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Erreur</title>
</head>
<body>
	<h1>
		<?php
			if ($_GET["code"] == 403) {
				?>
				Accès refusé
				<?php
			}
			else if ($_GET["code"] == 404) {
				?>
				Page non trouvée
				<?php
			}
			else if ($_GET["code"] == 500) {
				?>
				Erreur interne
				<?php
			}
		?>
	</h1>
</body>
</html>