<?php
    require_once("action/AdminLoginAction.php");

    $action = new AdminLoginAction();
    $action->execute();

    require("partial/header.php")

?>

<div id="loginDiv">
    <form action="admin-login.php" method="POST">
    
    </form>
</div>

<?php

    require_once("partial/footer.php");