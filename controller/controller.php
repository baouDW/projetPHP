<?php
session_start();



require('./model/model.php');

function listPosts(){
	$posts= getPosts();
	require('./view/accueilView.php');
}

function insertP(){

	$insertPost= insertPost($_POST['titre'], $_POST['texte']);

	header('Location: ./view/adminView.php');
}

function addComment(/*$postId, $author, $comment*/)
{
    //$affectedLines = postComment($postId, $author, $comment);
    $affectedLines = postComment($_GET['id'], $_POST['author'], $_POST['comment']);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
       // header('Location: view/postView.php');
        header('Location: ./index.php');
    }
}

function updateView(){
	$post= getPost($_GET['id']);
	require('./view/updateView.php');
}

function update(){
	$update= UptdatePost($_POST['titre'], $_POST['texte'], $_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function signal(){
	$Signalement= Signalement($_GET['id']);
	header('Location: ./view/crudView.php');
}

function delete(){
	$delete=deletePost($_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function posts(){
	$post= getPost($_GET['id']);
	$comments=getComments($_GET['id']);
	require('./view/postView.php');
}

function commentsAdmin(){
	$post= getPost($_GET['id']);
	$comments=getComments($_GET['id']);
	require('./view/commentView.php');
}

function membreView(){
	$user = getUser();
	require('./view/userView.php');
}

function delcomm(){
	$delcomm=deleteComment($_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function signup(){
	$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$inscription=inscription($_POST['Nom'], $_POST['Prenom'], $_POST['pseudo'], $pass_hache, $_POST['email']);
	//header('Location: ./view/crudView.php');
}

function login(){
	$posts= getPosts();
	$verifuser = verifUser($_POST['pseudo']);	
	$isPasswordCorrect = password_verify($_POST['pass'], $verifuser['pass']);
	

	if (!$verifuser)
	{
    	echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
    	if (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (!isset($_POST['rapel']))){
    		session_destroy();
	        session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        require('./view/crudView.php');
	    }
	    elseif (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (isset($_POST['rapel']))) {
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
			require('/view/crudView.php');
	    }
	    elseif (($isPasswordCorrect) && (!isset($_POST['rapel']))){
	    	session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        header('Location: ./index.php');
	    }
	    elseif (($isPasswordCorrect) && (isset($_POST['rapel'])) && ($_POST['pseudo'] !== 'admin')) {
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
			header('Location: ./index.php');
	    }
	    else{
	    	echo "Mauvais identifiant ou mot de passe !!!";
	    }
	}
}

function adminaccess(){
	$posts= getPosts();
	require('/view/crudView.php');
}

function deconexion(){
		
	session_start();

	// Suppression des variables de session et de la session
	$_SESSION = array();
	session_destroy();

	// Suppression des cookies de connexion automatique
	setcookie('id', '');
	setcookie('pseudo', '');
	header('Location: ./index.php');
}

