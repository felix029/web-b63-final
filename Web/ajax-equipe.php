<?php
    require_once("action/AjaxEquipeAction.php");

    $action = new AjaxEquipeAction();
    $action->execute();

    echo $action->result;