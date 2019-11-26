<?php
	require_once("action/EquipeAction.php");

	$action = new EquipeAction();
	$action->execute();

	require_once("partial/header.php");


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
?>
	</div>
<?php

	require_once("partial/footer.php");