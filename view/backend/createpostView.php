<?php
require('../../model/model.php');
$manager = new Manager();
$posts= $manager->getPosts();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Ecrire un chapitre</title>
    <link rel="stylesheet" href="../public/css/tinycss.css">
    <script src="../public/js/editeur.js"></script>
    <!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>-->
  </head>
  <body>
    





<?php ob_start(); ?>

<div>
    <form method="post" action="../../index.php?action=insertPost">
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
            <?= nl2br($data['content']) ?>
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


<?php $content = ob_get_clean(); ?>
<?php require('templateBackend.php'); ?>

  </body>
</html>



