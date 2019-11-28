<?php
    require_once("action/AjaxEquipeAction.php");

    $action = new AjaxEquipeAction();
    $action->execute();

    echo json_encode($action->result);