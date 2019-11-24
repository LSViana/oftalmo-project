<?php
require_once __DIR__ . "/" . "../../jpgraph/jpgraph.php";
require_once __DIR__ . "/" . "../../jpgraph/jpgraph_bar.php";
require_once __DIR__ . "/" . "../../jpgraph/jpgraph_pie.php";
require_once __DIR__ . "/" . "../../data/laboratories_repository.php";
require_once __DIR__ . "/" . "../../data/softwares_repository.php";


class ChartsController {
    private $laboratoriesRepository;
    private $softwaresRepository;

    public function __construct() {
        $this->laboratoriesRepository = new LaboratoriesRepository();
        $this->softwaresRepository = new SoftwaresRepository();
    }

    public function computersByLaboratory() {
        list($laboratories, $computersAmounts) = $this->computersByLaboratoryData();

        // Create the graph. These two calls are always required
        $graph = new Graph(600,300,'auto');
        $graph->SetScale("textlin");
        $graph->ygrid->SetFill(false);
        $graph->xaxis->SetTickLabels(array_map(function ($item) { return $item["name"]; }, $laboratories));
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false, false);
        $graph->yaxis->SetColor('white');
        $graph->xaxis->SetColor('white');
        $softwareByLaboratoryPlot = new BarPlot($computersAmounts);
        $graph->Add($softwareByLaboratoryPlot);
        $graph->SetMarginColor(DARK_COLOR, DARK_COLOR);
        $graph->SetColor(DARK_COLOR);
        $graph->SetFrame(true, DARK_COLOR, 1);
        $softwareByLaboratoryPlot->SetColor(PRIMARY_COLOR);
        $softwareByLaboratoryPlot->SetFillColor(PRIMARY_COLOR);

        // Display the graph
        $graph->Stroke();

    }

    public function softwareByLaboratory() {
        list($laboratories, $softwareAmounts) = $this->softwaresByLaboratoryData();

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
    }

    public function colorsBySoftwareByLaboratory() {

        list($laboratory, $colors, $colorsCount, $softwareNames, $softwares) = $this->colorsBySoftwareByLaboratoryData();

        $graph = new PieGraph(600,300);

        $p1 = new PiePlot($colorsCount);
        $graph->title->Set($laboratory["name"]);
        $graph->title->SetColor('white');
        $graph->Add($p1);
        $p1->SetSize(0.35);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->value->SetColor('white');
        $p1->SetSliceColors($colors);
        $p1->SetLabels($softwareNames);
        $p1->SetLabelPos(1);

        $graph->SetMarginColor(DARK_COLOR, DARK_COLOR);
        $graph->SetColor(DARK_COLOR);
        $graph->SetFrame(true, DARK_COLOR, 1);
        $graph->Stroke();
    }

    /**
     * @return array
     */
    public function computersByLaboratoryData(): array
    {
        // Fetching values from storage
        $laboratories = $this->laboratoriesRepository->laboratories_list();

        $computersAmounts = array_map(function ($item) {
            return $item["computers"];
        }, $laboratories);

        return [
            $laboratories,
            $computersAmounts
        ];
    }

    /**
     * @return array
     */
    public function softwaresByLaboratoryData(): array
    {
// Fetching values from storage
        $laboratories = $this->laboratoriesRepository->laboratories_list();

        $softwareAmounts = array_map(function ($item) {
            return sizeof($item["softwares"]);
        }, $laboratories);
        return array($laboratories, $softwareAmounts);
    }

    /**
     * @return array
     */
    public function colorsBySoftwareByLaboratoryData(): array
    {
        $laboratories = $this->laboratoriesRepository->laboratories_list();
        $laboratory = null;
        foreach ($laboratories as $item) {
            if ($item["id"] == $_GET["id"]) {
                $laboratory = $item;
            }
        }
        $softwares = array();
        $colors = array();
        $colorsCount = array();
        $softwareNames = array();
        foreach ($laboratory["softwares"] as $software) {
            $temp = $this->softwaresRepository->softwares_read($software);
            array_push($softwares, $temp);
            array_push($colors, $temp["color"]);
            array_push($softwareNames, $temp["name"] . ' (%.1f%%)');
        }

        foreach ($colors as $color) {
            $count = 0;
            foreach ($softwares as $software) {
                if ($software["color"] == $color) {
                    $count += 1;
                }
            }
            array_push($colorsCount, $count);
        }
        return array($laboratory, $colors, $colorsCount, $softwareNames, $softwares);
    }
}
?>
