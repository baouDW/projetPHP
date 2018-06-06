<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Mon éditeur WYSIWYG</title>
    <link rel="stylesheet" href="../public/css/tinycss.css">
    <script src="../public/js/editeur.js"></script>
  </head>
  <body>
      <input type="button" value="G" style="font-weight:bold;" onclick="commande('bold');" ></code> 
      <input type="button" value="I" style="font-style:italic;" onclick="commande('italic');" ></code> 
      <input type="button" value="S" style="text-decoration:underline;" onclick="commande('underline');" ></code>  
      <input type="button" value="Lien" onclick="commande('createLink');" ></code>
      <input type="button" value="Image" onclick="commande('insertImage');" ></code>
      <select onchange="commande('heading', this.value); this.selectedIndex = 0;">
        <option value="">Titre</option>
        <option value="h1">Titre 1</option>
        <option value="h2">Titre 2</option>
        <option value="h3">Titre 3</option>
        <option value="h4">Titre 4</option>
        <option value="h5">Titre 5</option>
        <option value="h6">Titre 6</option>
    </select>
      <div id="editeur" contentEditable ></div> 


      <input type="button" onclick="resultat();" value="Obtenir le HTML" ></code><br />
    <textarea id="resultat"></textarea>
    <?php $content = ob_get_clean(); ?>
    <?php require('./templateBackend.php'); ?>
  </body>
</html>



