<?php

namespace Controller;

use Systeme\Helper;
use Manager\PictureReportManager;

/**
 * Gere l ajout et la suppression des reports sur les photos
 */
class PictureReportController
{
    public function __construct()
    {
        return $this->report();
    }

    /**
     * Gere reports photos
     */
    public function report()
    {
        $postClean = Helper::cleanArray($_POST);
        $sucess = 0;
        $reportStatus = 0;
        $reportsNumber = 0;
        $data = [];
        $message = "Une erreur est survenue ...";

        $pictureReportManager = new PictureReportManager();
        $reports = $pictureReportManager->getPicturesReportsByPictureId($postClean['elementIdReport']);
        foreach ($reports as $report) {
            //Verifie si utilisateur a reporte la photo si report efface report
            if ($report->getUserId()->getUserId() == $postClean['userIdReport']) {
                $reportStatus = 1;
                $sucess = 1;
                //Efface report photo
                $pictureReportManager->delete($report->getPictureReportId());
                //Nombre report photo
                $reportsNumber = $pictureReportManager->getPicturesReportsNumberByPictureId($postClean['elementIdReport']);
                $data = [
                    "reportsNumber" => $reportsNumber,
                    "post" => $postClean,
                ];
                $message = "report effacé";
            }
        }

        //Ajout Report
        if ($reportStatus === 0) {
            $sucess = 1;
            //Ajout report a la base de donnees
            $pictureReportManager->add($postClean['elementIdReport'], $postClean['userIdReport']);
            //Nombre report photo
            $reportsNumber = $pictureReportManager->getPicturesReportsNumberByPictureId($postClean['elementIdReport']);
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