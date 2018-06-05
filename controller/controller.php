<?php
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

function update(){
	$update= UptdatePost($_POST['titre'], $_POST['texte'], $_GET['id']);
	header('Location: ./view/crudView.php');
}

function signal(){
	$Signalement= Signalement($_GET['id']);
	header('Location: ./view/crudView.php');
}

function delete(){
	$delete=deletePost($_GET['id']);
	header('Location: ./view/adminView.php');
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

function delcomm(){
	$delcomm=deleteComment($_GET['id']);
	header('Location: ./view/crudView.php');
}

function signup(){
	$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$inscription=inscription($_POST['Nom'], $_POST['Prenom'], $_POST['pseudo'], $pass_hache, $_POST['email']);
	//header('Location: ./view/crudView.php');
}

function login(){
	
	$verifuser = verifUser($_POST['pseudo']);	
	$isPasswordCorrect = password_verify($_POST['pass'], $verifuser['pass']);
	
	if (!$verifuser)
	{
    	echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
    	if (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (!isset($_POST['rapel']))){
	        session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        header('Location: ./view/crudView.php');
	    }
	    elseif (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (isset($_POST['rapel']))) {
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
	    }
	    elseif (($isPasswordCorrect) && (!isset($_POST['rapel']))){
	    	session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        echo 'Vous êtes connecté !';
	    }
	    elseif (($isPasswordCorrect) && (isset($_POST['rapel'])) && ($_POST['pseudo'] !== 'admin')) {
	    	echo "cookie en place";
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
	    }
	    else{
	    	echo "Mauvais identifiant ou mot de passe !!!";
	    }
	}
}