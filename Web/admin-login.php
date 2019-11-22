<?php
    require_once("action/AdminLoginAction.php");

    $action = new AdminLoginAction();
    $action->execute();

    require("partial/header.php")

?>

<div id="loginDiv">
    <form action="admin-login.php" method="POST">
        <?php
            if($action->wrongLogin){
                ?>
                    <div id="login-error">Erreur: Connexion erroné</div>
                <?php
            }
            else{
                ?>
                    <div id="login-title">Connexion</div>
                <?php
            }
        ?>
        <div>
            <label>Nom d'utilisateur:</label>
            <input type="text" name="username" />
        </div>
        <div>
            <label>Mot de passe:</label>
            <input type="password" name="pwd" />
        </div>
        <button id="buttonLogin">Connexion</button>
    </form>
</div>

<?php

    require_once("partial/footer.php");