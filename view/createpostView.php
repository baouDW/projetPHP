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