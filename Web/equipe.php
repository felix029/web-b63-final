<?php
	require_once("action/EquipeAction.php");

	$action = new EquipeAction();
	$action->execute();

	require_once("partial/header.php");


    $team = UserDAO::getTeam();
    foreach($team as $key => $value){
        ?>
            <div class="team-container" id="team<?= $key; ?>">
				<div class="team-photo"><img src=<?= $value[3] ?> alt=<?= $value[3] ?>></div>
				<div class="team-name"><?= $value[0] ?></div>
				<div class="team-job"><?= $value[1] ?></div>
				<div class="team-bio"><?= $value[2] ?></div>
            </div>
        <?php
    }
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