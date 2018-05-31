<?php
//require('model/model.php');
//$posts= getPosts();
?>
<p><a href="view/loginView.php">Acces a l'espace administration</a></p>
<h2>Bienvenue sur le blog de l'ecrivain</h2>


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
            <em><a href="index.php?id=<?= $data['id'] ?>&action=comm">Commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>