<?php
function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM billets ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}

function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM billets WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM commentaires WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO commentaires (post_id, author, comment, comment_date) VALUES(:post_id, :author, :comment, NOW())');
    $affectedLines = true;
    $comments->execute(array(
    'post_id' => $postId,
    'author' => $author,   
    'comment' => $comment  
    ));
    return $affectedLines;
}

function insertPost($title,$content)
{
    $db = dbConnect();
    $req = $db->prepare('INSERT INTO billets (title, content, creation_date) VALUES (:title, :content, NOW())');
    $req->execute(array(
    'title' => $title,
    'content' => $content    
    ));
        
}

function UptdatePost($title, $content, $id)
{
    $db = dbConnect();
    $req = $db->prepare('UPDATE billets SET title = :nvtitle, content = :nvcontent WHERE id= :id');
    $req->execute(array(
    'nvtitle' => $title,
    'nvcontent' => $content,
    'id' => $id
    ));    
}

function deletePost($id)
{
    $db = dbConnect();
    $req = $db->prepare('DELETE FROM billets WHERE id= :id');
    $req->execute(array(
    'id' => $id    
    ));
}

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
