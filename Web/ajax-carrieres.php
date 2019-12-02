<?php
    require_once("action/AjaxCarrieresAction.php");

    $action = new AjaxCarrieresAction();
    $action->execute();

    echo json_encode($action->result);