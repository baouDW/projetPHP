<?php
$title = $post['title'];
?>
<!-- Page Header -->
<?php ob_start(); ?>
    <header class="masthead" style="background-image: url('img/post-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1><?= $post['title'] ?></h1>
              
              <span class="meta">Poster le <?= $post['creation_date_fr'] ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>
    
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <p>
              <?= $post['content']?>
            </p>
          </div>
        </div>
      </div>
    </article>

    <hr>
    
    
        <div class="container">
            <form action="./index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <p>
                    <label for="author">
                        Auteur
                    </label>
                    <br />           
                    <input type="text" name="author" value="<?php if (isset($_SESSION['pseudo'])) {
                        echo $_SESSION['pseudo'] ;
                    }elseif (isset($_COOKIE['pseudo'])) {
                        echo $_COOKIE['pseudo'] ;

                    }?>"> 

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
        <div class="container">
            <h2>Commentaires</h2>

            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p><a href="./index.php?action=signal&amp;id=<?= $comment['id'] ?>">Signaler</a>
            <?php
            }
            ?>
            <?php $content = ob_get_clean(); ?>
            
            <?php require('templateFront.html'); ?>
        </div>
</html>


