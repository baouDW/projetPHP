<?php
require('controller/controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'suppr') {
        delete();
    }
    elseif ($_GET['action'] == 'comm') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            posts();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    elseif ($_GET['action'] == 'signal') {
        if (isset($_GET['id']))
        {
            signal();
        }
        else {
            echo 'Erreur : aucun identifiant de commentaire envoyé';
        }
    }

    elseif ($_GET['action'] == 'modif') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            update();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    elseif ($_GET['action'] == 'insertPost') {
        if (isset($_POST['titre'])) {
            insertP();
        }
        else {
            echo 'Erreur : aucun titre envoyé';
        }
    }

    elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            error_log('hkhkjuj');
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                //addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                addComment();
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'commadmin') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            commentsAdmin();
        }
        else {
            echo 'erreur';
        }
    }

    elseif ($_GET['action'] == 'delcomm') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
           delcomm();
            //header('Location: ./view/commentView.php');
        }
        else {
            echo 'hgkhh';
        }
    }

    elseif ($_GET['action'] == 'inscription') {
        if ($_POST['password'] == $_POST['confirm_password']) {           
            signup();
        }
        else {
            echo 'Mot de passe differents <p><a href="view/signUpView.php">Retour</a></p>' ;
        }
    }

    elseif ($_GET['action'] == 'login') {
        
        if (isset($_POST['pseudo']) && isset($_POST['pass'])) {           
            login();
        }
        else {
            echo 'id et ou mdp manquant <p><a href="view/signUpView.php">Retour</a></p>' ;
        }

    }

}
else {
    listPosts();
}