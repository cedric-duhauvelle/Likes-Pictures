<?php

namespace Controller;

use Systeme\Helper;
use Manager\ReportManager;

class ReportController
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
        $reportManager = new ReportManager();
        $reports = $reportManager->getReportsByElementId($postClean['elementIdReport'], $postClean['elementReport']);
        foreach ($reports as $report) {
            if ($report->getUser()->getId() == $postClean['userIdReport']) {
                $reportStatus = 1;
                $sucess = 1;

                $reportManager->delete($report->getId());

                $reportsNumber = $reportManager->getReportsNumberByElementId($postClean['elementIdReport'], $postClean['elementReport']);
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

            $reportManager->add($postClean['elementReport'], $postClean['elementIdReport'], $postClean['userIdReport']);
            $reportsNumber = $reportManager->getReportsNumberByElementId($postClean['elementIdReport'], $postClean['elementReport']);
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