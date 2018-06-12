<?php
session_start();



require('./model/model.php');

function listPosts(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	require('./view/frontend/accueilView.php');
}

function insertP(){
	$manager = new Manager();
	$insertPost= $manager->insertPost($_POST['titre'], $_POST['texte']);	
	header('Location: ./index.php?action=createView');
}

function addComment()
{
	$manager = new Manager();
    $affectedLines = $manager->postComment($_GET['id'], $_POST['author'], $_POST['comment']);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: ./index.php');
    }
}

function updateView(){
	$manager = new Manager();
	$post= $manager->getPost($_GET['id']);
	require('./view/backend/updateView.php');
}

function createView(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	require('./view/backend/createpostView.php');
}

function update(){
	$manager = new Manager();
	$update= $manager->UptdatePost($_POST['titre'], $_POST['texte'], $_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function signal(){
	$manager = new Manager();
	$Signalement= $manager->Signalement($_GET['id']);
	header('Location: ./index.php');
}

function delete(){
	$manager = new Manager();
	$delete= $manager->deletePost($_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function posts(){
	$manager = new Manager();
	$post= $manager->getPost($_GET['id']);
	$comments= $manager->getComments($_GET['id']);
	require('./view/frontend/postView.php');
}

function commentsAdmin(){
	$manager = new Manager();
	$post= $manager->getPost($_GET['id']);
	$comments= $manager->getComments($_GET['id']);
	require('./view/backend/commentView.php');
}

function membreView(){
	$manager = new Manager();
	$user = $manager->getUser();
	require('./view/backend/userView.php');
}

function delcomm(){
	$manager = new Manager();
	$delcomm= $manager->deleteComment($_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function signup(){
	$manager = new Manager();
	$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$inscription= $manager->inscription($_POST['Nom'], $_POST['Prenom'], $_POST['pseudo'], $pass_hache, $_POST['email']);
	header('Location: ./index.php');
}

function login(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	$verifuser = $manager->verifUser($_POST['pseudo']);	
	$isPasswordCorrect = password_verify($_POST['pass'], $verifuser['pass']);
	

	if (!$verifuser)
	{

           header('Location: view/frontend/loginViewError.php');
    	echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
    	if (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (!isset($_POST['rapel']))){
    		session_destroy();
	        session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        require('./view/backend/crudView.php');
	    }
	    elseif (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (isset($_POST['rapel']))) {
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
			require('/view/backend/crudView.php');
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
	$manager = new Manager();
	$posts= $manager->getPosts();
	require('./view/backend/crudView.php');
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

