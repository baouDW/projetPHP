<?php
//require('./model/model.php');
//$post = getPost($_GET['id']);
//$comments=getComments($_GET['id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
        <div>
            <form action="./index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <p>
                    <label for="author">
                        Auteur
                    </label>
                    <br />           
                    <input type="text" name="author">       
                </p>
                <p>
                    <label for="comment">
                        Commentaire
                    </label>
                    <br />           
                    <textarea name="comment" id="comment" rows="10" cols="50"></textarea>       
                </p>
                <p><input type="submit" name="ajouter" value="Ajouter un commentaire"></p>
            </form>
        </div>
        <h2>Commentaires</h2>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <?php
        }
        ?>
    </body>
</html>