<?php
require('../model/model.php');
$posts= getPosts();
?>
<a href="../index.php">Retour a l'accueil</a>
<div>
    <form method="post" action="../index.php?action=insertPost">
        <p>
           <label for="titre">
          Titre
           </label>
           <br />           
           <input type="text" name="titre">       
       </p>
       <p>
           <label for="texte">
          Texte
           </label>
           <br />           
           <textarea name="texte" id="texte" rows="10" cols="50"></textarea>       
       </p>
       <p><input type="submit" name="ajouter" value="Ajouter un article"></p>
    </form>
</div>
<?php
while ($data = $posts->fetch())
{
?>    
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
                
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="../index.php?id=<?= $data['id'] ?>&action=comm">Afficher les commentaires</a></em>
            <em><a href="updateView.php?id=<?= $data['id'] ?>">Modifier</a></em>
            <em><a href="../index.php?id=<?= $data['id'] ?>&action=suppr">supprimer</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?> 



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Mon éditeur WYSIWYG</title>
    <link rel="stylesheet" href="../public/css/tinycss.css">
    <script src="../public/js/editeur.js"></script>
  </head>
  <body>
    <form method="post" action="../index.php?id=<?php echo $_GET['id'] ?>&action=insertPost">
        <p>
           <label for="titre">
          Titre
           </label>
           <br />           
           <input type="text" name="titre" >       
       </p>


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

  </body>
</html>



