<?php
//require('model/model.php');
//$posts= getPosts();
$title = 'Accueil'; 
?>




<?php ob_start(); ?>

<?php

while ($data = $posts->fetch())
{
?>    
    <div class="post-preview">
            <a href="index.php?id=<?= $data['id'] ?>&action=comm">
              <h2 class="post-title">
                <?= htmlspecialchars($data['title']) ?>
              </h2>
              <h3 class="post-subtitle">
                extrait
              </h3>
            </a>
            <p class="post-meta">Poster le <?= $data['creation_date_fr'] ?></p>
        </div>
        <hr>    
        
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>
<?php require('./templateFront.html'); ?>