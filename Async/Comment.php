<?php

namespace Async;

include('../Systeme/AutoLoad.php');

use Systeme\Router;
use Manager\UserManager;
use Manager\CommentManager;



$router = new Router();
$postClean = $router->cleanArray($_POST);

$sucess = 0;
$msg = 'Une erreur est survenue ... (php)';


if ($postClean['comment'] !== "") {
    $sucess = 1;
    $userManager = new UserManager();
    $commentManager = new CommentManager();
    $user = $userManager->getUserById($postClean['userId']);
    $commentManager->add($postClean['userId'], $postClean['pictureId'], $postClean['comment']);
    $comment = $commentManager->getCommentLast();
    $commentDate = date_format(date_create($comment->getPublished()), 'd/m/Y à H:i');

    $data = ["comment" => $postClean['comment'], "pictureId" => $postClean['pictureId'], "userName" => $user->getName(), "userId" => $user->getId(), "published" => $commentDate, "commentId" => $comment->getId()];
    $msg = "";

} else {
    $data = [];
    $msg = "Veuillez écrire un commentaire";
}

$res = ["sucess" => $sucess, "msg" => $msg, "data" => $data];




echo json_encode($res);