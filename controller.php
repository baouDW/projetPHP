<?php
require('model/model.php');

function listPosts(){
	$posts= getPosts();
	require('view/accueilView.php');
}

function insertP(){

	$insertPost= insertPost($_POST['titre'], $_POST['texte']);

	header('Location: view/adminView.php');
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
        header('Location: index.php');
    }
}

function update(){
	$update= UptdatePost($_POST['titre'], $_POST['texte'], $_GET['id']);
	header('Location: view/adminView.php');
}

function delete(){
	$delete=deletePost($_GET['id']);
	header('Location: view/adminView.php');
}

function posts(){
	$post= getPost($_GET['id']);
	$comments=getComments($_GET['id']);
	require('view/postView.php');
}


