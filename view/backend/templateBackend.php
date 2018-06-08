<?php
//require('view/crudView.php');
//session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>admin</title>
  <link rel="stylesheet" href="public/css/templateback.css">
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
  <div class="contain">
    <div class="menu-back">
      <a href="index.php" class="item-menu-back">Blog d'écrivain</a>
    </div>
    <div class="menu-back">
      <a href="index.php" class="item-menu-back">Accueil</a>
      <a href="index.php?action=deconexion" class="item-menu-back">Déconnexion</a>
    </div>
  </div>
  <div class="menu-lat">
    <div class="contain-lateral">
      <div class="item-lateral"><a href="index.php?action=adminaccess">accueil admin</a></div>
      <div class="item-lateral"><a href="./index.php?action=createView">écrire un chapitre</a></div>
      <div class="item-lateral"><a href="index.php?action=membreView">Voir les membres</a></div>
    </div>
    <div class="">
      <?= $content ?>
    </div>
  </div>
</body>
</html>   