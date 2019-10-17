<?php

namespace Controller;

use Systeme\Helper;
use Manager\PictureReportManager;
use Manager\CommentReportManager;
use Manager\PictureManager;
use Manager\CommentManager;
use Manager\UserManager;

class AdminController
{
    public function __construct()
    {
        return $this->admin();
    }

    /**
     * Gere la suppresion des elements signales et des utilisateurs
     */
    public function admin()
    {
        $sucess = 0;
        $message = 'Une erreur est survenue...';
        $data = [];

        $postClean = Helper::cleanArray($_POST);

        $pictureReportManager = new PictureReportManager();
        $commentReportManager = new CommentReportManager();

        //Efface une photo signalee
        if (array_key_exists('picture_id_admin', $postClean)) {
            $sucess = 1;
            $message = 'Photo effacée';

            $pictureReportManager->delete($postClean['report_id_admin']);
            $pictureManager = new PictureManager();
            $pictureManager->delete($postClean['picture_id_admin']);
            unlink('img/upload/picture/' . $postClean['picture_title_admin'] . $postClean['picture_id_admin'] . '.jpg');
        //Efface un signalement d une photo signalee
        } elseif (array_key_exists('report_id_admin', $postClean)) {
            $sucess = 1;
            $message = 'Report effacé';

            $pictureReportManager->delete($postClean['report_id_admin']);
        //Efface un commentaire signale
        } elseif (array_key_exists('commentId_report_id', $postClean)) {
            $sucess = 1;
            $message = 'Commentaire effacé';

            $commentReportManager->delete($postClean['comment_report_id']);
            $comment = new CommentManager();
            $comment->delete($postClean['commentId_report_id']);
        //Efface le signalement d un commentaire
        } elseif (array_key_exists('comment_report_id', $postClean)) {
            $sucess = 1;
            $message = 'Report effacé';

            $commentReportManager->delete($postClean['comment_report_id']);
        //Efface un utilisateur
        } elseif (array_key_exists('user_id_admin', $postClean)) {
            $sucess = 1;
            $message = 'Utilisateur effacé';

            $userManager = new UserManager();
            $userManager->delete($postClean['user_id_admin']);
            unlink('img/upload/avatar/avatar' . $postClean['user_id_admin'] . '.jpg');
        }
        $data = [
            "post" => $postClean,
            "message" => $message,
        ];
        echo json_encode([
            "sucess" => $sucess,
            "data" => $data,
        ]);
    }
}