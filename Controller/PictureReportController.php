<?php

namespace Controller;

use Systeme\Helper;
use Manager\PictureReportManager;

class PictureReportController
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
        $pictureReportManager = new PictureReportManager();
        $reports = $pictureReportManager->getPicturesReportsByPictureId($postClean['elementIdReport']);
        foreach ($reports as $report) {
            if ($report->getUserId()->getUserId() == $postClean['userIdReport']) {
                $reportStatus = 1;
                $sucess = 1;

                $pictureReportManager->delete($report->getPictureReportId());

                $reportsNumber = $pictureReportManager->getPicturesReportsNumberByPictureId($postClean['elementIdReport']);
                $data = [
                    "reportsNumber" => $reportsNumber,
                    "post" => $postClean,
                ];
                $message = "report effacer";
            }
        }

        //Ajout un report
        if ($reportStatus === 0) {
            $sucess = 1;

            $pictureReportManager->add($postClean['elementIdReport'], $postClean['userIdReport']);
            $reportsNumber = $pictureReportManager->getPicturesReportsNumberByPictureId($postClean['elementIdReport']);
            $data = [
                "reportsNumber" => $reportsNumber,
                "post" => $postClean,
            ];
            $message = "report ajouter";
        }
        echo json_encode([
            "sucess" => $sucess,
            "message" => $message,
            "data" => $data,
        ]);
    }
}