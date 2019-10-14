<?php

namespace Controller;

use Systeme\Helper;
use Manager\CommentReportManager;

/**
 * Gere l ajout et la suppression des sigalements des commentaires
 */
class CommentReportController
{
    public function __construct()
    {
        return $this->report();
    }

    public function report()
    {
        $postClean = Helper::cleanArray($_POST);
        $sucess = 0;
        $reportStatus = 0;
        $reportsNumber = 0;
        $data = [];
        $message = "Une erreur est survenue ...";

        //Recherche si l element est report si report efface report
        $commentReportManager = new CommentReportManager();
        $reports = $commentReportManager->getCommentsReportsByCommentId($postClean['elementIdReport']);
        foreach ($reports as $report) {
            if ($report->getUserId()->getUserId() == $postClean['userIdReport']) {
                $reportStatus = 1;
                $sucess = 1;

                $commentReportManager->delete($report->getCommentReportId());

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

            $commentReportManager->add($postClean['elementIdReport'], $postClean['userIdReport']);
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