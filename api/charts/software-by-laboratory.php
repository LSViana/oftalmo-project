<?php // content="text/plain; charset=utf-8"
require_once __DIR__ . "/" . "../../jpgraph/jpgraph.php";
require_once __DIR__ . "/" . "../../jpgraph/jpgraph_bar.php";
require_once __DIR__ . "/" . "../../data/laboratories_repository.php";

$laboratoriesRepository = new LaboratoriesRepository();

// Fetching values from storage
$laboratories = $laboratoriesRepository->laboratories_list();

$softwareAmounts = array_map(function ($item) {
    return sizeof($item["softwares"]);
}, $laboratories);

// Create the graph. These two calls are always required
$graph = new Graph(600,300,'auto');
$graph->SetScale("textlin");
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array_map(function ($item) { return $item["name"]; }, $laboratories));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false, false);
$graph->yaxis->SetColor('white');
$graph->xaxis->SetColor('white');
$softwareByLaboratoryPlot = new BarPlot($softwareAmounts);
$graph->Add($softwareByLaboratoryPlot);
$graph->SetMarginColor(DARK_COLOR, DARK_COLOR);
$graph->SetColor(DARK_COLOR);
$graph->SetFrame(true, DARK_COLOR, 1);
$softwareByLaboratoryPlot->SetColor(PRIMARY_COLOR);
$softwareByLaboratoryPlot->SetFillColor(PRIMARY_COLOR);

// Display the graph
$graph->Stroke();
?>
