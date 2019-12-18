
<?php

//require 'C:/xampp2/php/pear/PhpSpreadsheet/vendor/autoload.php';
require 'PhpSpreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$helper = new Sample();



$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

$spreadsheet->createSheet();
$wok2Name="DataForcharts";
$worksheet2=$spreadsheet->getSheet(1)->setTitle($wok2Name);



include "includes/db_connect.php";
$selectLink="SELECT dns FROM config";
$selectLink=$conn->query($selectLink);
$selectLink=$selectLink->fetch(PDO::FETCH_ASSOC);
$url="http://".$selectLink['dns'].":8080/TestingServices/CustomerFeedback/includes/Analytics/getSurveyDetails.php?surveyId=".$_GET['surveyId'];

$data = (file_get_contents($url));
$data=json_decode($data,true);
echo "<pre>";
print_r($data);
echo "</pre>";

?>
