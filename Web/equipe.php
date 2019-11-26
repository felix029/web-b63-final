<?php
	require_once("action/EquipeAction.php");

	$action = new EquipeAction();
	$action->execute();

	require_once("partial/header.php");
?>

<template id="team">
<div class="team-container">
	<div class="team-photo"></div>
	<div class="team-name"></div>
	<div class="team-job"></div>
	<div class="team-bio"></div>
</div>
</template>

<?php
	if($action->isLoggedIn()){
		?>
			<form action="equipe.php" method="POST">
				<div id="new-team-member">

				</div>
			</form>


			<form action="equipe.php" method="POST">
				<div id="delete-team-member">

				</div>
			</form>
		<?php
	}
	else{
		?>

		<?php
	}

	require_once("partial/footer.php");