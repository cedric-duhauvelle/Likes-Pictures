<?php

namespace Controller;

use Systeme\Helper;
use Manager\CommentReportManager;

/**
 * Gere l ajout et la suppression des reports des commentaires
 */
class CommentReportController
{
    public function __construct()
    {
        return $this->report();
    }

    /**
     * Gere reports commentaires
     */
    public function report()
    {
        $postClean = Helper::cleanArray($_POST);
        $sucess = 0;
        $reportStatus = 0;
        $reportsNumber = 0;
        $data = [];
        $message = "Une erreur est survenue ...";

        $commentReportManager = new CommentReportManager();
        $reports = $commentReportManager->getCommentsReportsByCommentId($postClean['elementIdReport']);
        foreach ($reports as $report) {
            //Verifie si utilisateur a reporte le commentaire si report efface report
            if ($report->getUserId()->getUserId() == $postClean['userIdReport']) {
                $reportStatus = 1;
                $sucess = 1;
                //Efface report commentaire
                $commentReportManager->delete($report->getCommentReportId());
                //Nombre report commentaire
                $reportsNumber = $commentReportManager->getCommentsReportsNumberByCommentId($postClean['elementIdReport']);
                $data = [
                    "reportsNumber" => $reportsNumber,
                    "post" => $postClean,
                ];
                $message = "report effacé";
            }
        }

        //Ajout un report
        if ($reportStatus === 0) {
            $sucess = 1;
            //Ajout report a la base de donnees
            $commentReportManager->add($postClean['elementIdReport'], $postClean['userIdReport']);
            // Nombre report commentaire
            $reportsNumber = $commentReportManager->getCommentsReportsNumberByCommentId($postClean['elementIdReport']);
            $data = [
                "reportsNumber" => $reportsNumber,
                "post" => $postClean,
            ];
            $message = "report ajouté";
        }
        echo json_encode([
            "sucess" => $sucess,
            "message" => $message,
            "data" => $data,
        ]);
    }
}