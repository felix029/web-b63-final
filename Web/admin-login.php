<?php
    require_once("action/AdminLoginAction.php");

    $action = new AdminLoginAction();
    $action->execute();

    require("partial/header.php")

?>

<div id="loginDiv">
    <form action="admin-login.php" method="POST" id="admin-login">
        <?php
            if($action->wrongLogin){
                ?>
                    <div id="login-error" class="loginTitle">Erreur: Connexion erroné</div>
                <?php
            }
            else{
                ?>
                    <div id="login-title" class="loginTitle">Connexion</div>
                <?php
            }
        ?>
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" />
        <label>Mot de passe:</label>
        <input type="password" name="pwd" />
        <button id="buttonLogin" class="button">connexion</button>
    </form>
</div>
<div id="loginMobile">
    La gestion de ce site web n'est pas disponible sur sa version mobile.
</div>

<?php

    require_once("partial/footer.php");