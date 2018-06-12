<?php

require('controller/controller.php');
try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'suppr') {
            delete();
        }
        elseif ($_GET['action'] == 'comm') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                posts();
            }
            else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'signal') {
            if (isset($_GET['id']))
            {
                signal();
            }
            else {
                throw new Exception('Erreur : aucun identifiant de commentaire envoyé');
            }
        }

        elseif ($_GET['action'] == 'modif') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                update();
            }
            else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'insertPost') {
            if (isset($_POST['titre']) && isset($_POST['texte'])) {
                insertP();
            }
            else {
                throw new Exception('Erreur : aucun titre envoyé ou texte');
            }
        }

        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                error_log('hkhkjuj');
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment();
                }
                else {
                    throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'commadmin') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                commentsAdmin();
            }
            else {
                throw new Exception('erreur');
            }
        }

        elseif ($_GET['action'] == 'delcomm') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               delcomm();
            }
            else {
                throw new Exception('id manquant');
            }
        }

        elseif ($_GET['action'] == 'inscription') {
            if ($_POST['password'] == $_POST['confirm_password']) {    signup();
            }
            else {
                header('Location: view/frontend/signUpView.php?diferent=diferent');
            }
        }

        elseif ($_GET['action'] == 'login') {
            
            if (isset($_POST['pseudo']) && isset($_POST['pass'])) {           
                login();
            }
            else { 
                throw new Exception( 'id et ou mdp manquant <p><a href="view/signUpView.php">Retour</a></p>') ;
            }
        }

        elseif ($_GET['action'] == 'adminaccess') {
            if ((isset($_SESSION['pseudo'])) && ($_SESSION['pseudo'] == 'admin'))
                {
                    adminaccess();
                }
            
        }

        elseif ($_GET['action'] == 'deconexion') {
            deconexion();
            
        }

        elseif ($_GET['action'] == 'membreView') {
           membreView();        
            
        }
        elseif ($_GET['action'] == 'upview') {
           updateView();        
            
        }

        elseif ($_GET['action'] == 'createView') {
           createView();        
            
        }

    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}