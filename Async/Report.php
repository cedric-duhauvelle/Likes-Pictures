<?php

namespace Async;

include('../Systeme/AutoLoad.php');

use Systeme\Router;
use Manager\ReportManager;


$router = new Router();

$postClean = $router->cleanArray($_POST);

$reportManager = new ReportManager();

$sucess = 0;
$reportStatus = 0;
$reportsNumber = 0;
$data = [];
$msg = "Une erreur est survenue ...";

$reports = $reportManager->getReportsByElementId($postClean['elementIdReport']);

foreach ($reports as $report) {

    if ($report->getUser()->getId() == $postClean['userIdReport']) {
        $msg = "report effacer";
        $reportStatus = 1;
        $sucess = 1;
        $reportManager->delete($report->getId());

        $reportsNumber = $reportManager->getReportsNumberByElementId($postClean['elementIdReport']);
        $data = ["reportsNumber" => $reportsNumber, "post" => $postClean];
    }

}
if ($reportStatus === 0) {
    $sucess = 1;
    $reportManager->add($postClean['elementReport'], $postClean['elementIdReport'], $postClean['userIdReport']);
    $msg = "report ajouter";
    $reportsNumber = $reportManager->getReportsNumberByElementId($postClean['elementIdReport']);
    $data = ["reportsNumber" =>$reportsNumber, "post" => $postClean];
}



$res = ["sucess" => $sucess, "msg" => $msg, "data" => $data];


echo json_encode($res);
