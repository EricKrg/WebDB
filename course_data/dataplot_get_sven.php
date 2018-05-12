<?php

if (!isset($_GET['file'])) {
    echo "No file defined!";
    exit();
}
$uploaddir = "files/";
$newpath = $uploaddir . $_GET['file'];

$datei = fopen($newpath, "r");

$summe = 0;
$count = 0;

while (!feof($datei)) {
    $zeile = fgets($datei, 1000);
    if ($zeile[0] != "#") {
        $pieces = explode("\t", $zeile);
        $ydata[$count] = (float) $pieces[1];
        $count = $count + 1;
    }
}
fclose($datei);

include ("jpgraph-4.2.0/src/jpgraph.php");
include ("jpgraph-4.2.0/src/jpgraph_line.php");

// Die Werte der Linie in ein Array speichern
//    $ydata = array(11, 3, 8, 12, 5, 1, 9, 13, 5, 7);
// Grafik generieren und Grafiktyp festlegen
$graph = new Graph(600, 400, "auto");
$graph->SetScale("intlin");

// Linie generieren
$lineplot = new LinePlot($ydata);

// Linie zur Grafik hinzufügen
$graph->Add($lineplot);

// Grafik Formatieren
$graph->img->SetMargin(40, 20, 20, 40);
$graph->title->Set("JPGraph Test");
$graph->xaxis->title->Set("X-title");
$graph->yaxis->title->Set("Y-title");

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$graph->yaxis->SetColor("red");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();

// Grafik anzeigen
$graph->Stroke();
?>
