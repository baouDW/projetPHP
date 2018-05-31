<?php
require('../model/model.php');
$post= getPost($_GET['id']);
?>
<div>
    <form method="post" action="../index.php?id=<?php echo $_GET['id'] ?>&action=modif">
        <p>
           <label for="titre">
          Titre
           </label>
           <br />           
           <input type="text" name="titre" value="<?php echo $post['title'] ?>">       
       </p>
       <p>
           <label for="texte">
          Texte
           </label>
           <br />           
           <textarea name="texte" id="texte" rows="10" cols="50" ><?php echo $post['content'] ?></textarea>       
       </p>
       <p><input type="submit" name="ajouter"></p>
    </form>
</div>

<?php
echo $post['title']."". $post['content']."".$_GET['id']."".$post['id'];
?>