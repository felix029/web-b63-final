<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/header.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <?php
        if($_SESSION["page"] == "equipe.php"){
            ?>
                <link rel="stylesheet" href="css/equipe.css">
            <?php
        }
        if($_SESSION["page"] == "carrieres.php"){
            ?>
                <link rel="stylesheet" href="css/carrieres.css">
            <?php
        }
        if($_SESSION["page"] == "galerie.php"){
            ?>
            <link rel="stylesheet" href="css/galerie.css">
            <?php
            if(($action->isLoggedIn() && $action->inPreview()) || !$action->isLoggedIn()){
                ?>
                <link rel="stylesheet" href="css/lightgallery.css">
                <script src="js/lightgallery.min.js"></script>
                <script src="js/gallerie.js"></script>
                <?php 
            }
        }        
        if($_SESSION["page"] == "services.php"){
            ?>
                <link rel="stylesheet" href="css/services.css">
                <script src="js/services.js"></script>
            <?php
        }
        if($_SESSION["page"] == "contact.php"){
            ?>
                <link rel="stylesheet" href="css/contact.css">
            <?php
        }
       
        if(($action->isLoggedIn() && $_SESSION["editable"] == true) && !$action->inPreview()){
            ?>

            <script src="js/editor.js"></script>
            <?php
            if($action->isAdmin()){
                ?>
                <title>DKoncept - Administration</title>
                <?php
            }
            else{
                ?>
                <title>DKoncept - Moderation</title>
                <?php
            }
        }
        else{

            if($_SESSION["editable"] == true){
                ?>
                <script src="js/contentViewer.js"></script>
                <?php
            }
            ?>
            <title>DKoncept</title>
            <?php
        }
        ?>
</head>
<body>
<header>
	<div id="head-logo">
        <img src="images/logo.png" alt="logo.png">
    </div>
    <?php
        if($action->isLoggedIn()){
            ?>
            <div id="admin-bar">
                <ul>
                    <li>Bonjour, <?= $_SESSION["username"] ?>!</li>
                    <?php
                        if($action->inPreview()){
                            ?>
                            <li><a href="?preview=false">Fin de l'apperçu</a></li>
                            <li><a href="home.php?preview=false">Paramètres</a></li>
                            <?php
                        }
                        else{
                            ?>
                            <li><a href="?preview=true">Apperçu du contenu</a></li>
                            <li><a href="home.php">Paramètres</a></li>
                            <?php
                        }
                    ?>

                    <li><a href="?logout=true">Déconnexion</a></li>
                </ul>
            </div>
            <?php
        }
    ?>
    <div id="hamburger">
        <img src="images/hamburger.png" alt="hamburger.png">
    </div>
    <nav>
        <ul id="list">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="resto.php">Le restaurant</a></li>
            <li><a href="equipe.php">L'équipe</a></li>
            <li><a href="carrieres.php">Carrières</a></li>
            <li><a href="galerie.php">Galerie Photos</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contactez-nous</a></li>
        </ul>
    </nav>
</header>

<div id="carousel">
	<div class="page1"></div>
	<div class="page2"></div>
	<div class="page3"></div>
	<div class="page4"></div>
</div>

<?php
    if(($action->isLoggedIn() && $_SESSION["editable"] == true) && !$action->inPreview()){
        ?>
            <button id="save-btn">sauvegarder</button>
        <?php
    }
?>

<div id="contentValue">
<?php
    //Fetching current page content
	if($_SESSION["editable"] == true){
		$pageContent = UserDAO::getPageContent($_SESSION["page"]);
        echo $pageContent;
    }
?>
</div>

<div id="content">
