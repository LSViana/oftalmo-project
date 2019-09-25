<?php // content="text/plain; charset=utf-8"
require_once __DIR__ . "/" . "./charts_controller.php";

$chartsController = new ChartsController();
$chartsController->softwareByLaboratory();
?>
