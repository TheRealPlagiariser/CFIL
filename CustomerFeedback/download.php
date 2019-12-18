
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
//print_r($data);
$worksheet->setCellValue('A1', ' Customer Feedback Report', true);
$worksheet->mergeCells("A1:D2");
$worksheet->getStyle("A1") ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$worksheet->getStyle("A1") ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$worksheet->getStyle('A1')->getFont()->setBold(true);
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setCoordinates('A1');
$drawing->setPath(__DIR__ . '/../images/mcblogo0.png');

$drawing->setHeight(36);
$drawing->setWorksheet($worksheet);

$worksheet->setCellValue('A3', 'Survey Details ', true);
$worksheet->setCellValue('A5', 'Survey', true);
$worksheet->setCellValue('A6', 'Project', true);
$worksheet->setCellValue('A7', 'Cycle', true);
$worksheet->setCellValue('A8', 'Number of Response', true);

$worksheet->setCellValue('B5', $data['surveyDetails'][0]['surveyName'], true);
$worksheet->setCellValue('B6', $data['surveyDetails'][0]['projectName'], true);
$worksheet->setCellValue('B7', $data['surveyDetails'][0]['cycleName'], true);
$worksheet->setCellValue('B8', $data['surveyDetails'][0]['numResponse'], true);

$worksheet->getStyle('B8')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

$worksheet->getColumnDimension('A')->setAutoSize(true);
$worksheet->getColumnDimension('B')->setAutoSize(true);
$worksheet->getColumnDimension('C')->setAutoSize(true);
$worksheet->getColumnDimension('D')->setAutoSize(true);
$worksheet->getColumnDimension('E')->setAutoSize(true);

$worksheet2->getColumnDimension('A')->setAutoSize(true);
$worksheet2->getColumnDimension('B')->setAutoSize(true);
$worksheet2->getColumnDimension('C')->setAutoSize(true);

// Set the Labels for each data series we want to plot
//     Datatype
//     Cell reference for data
//     Format Code
//     Number of datapoints in series
//     Data values
//     Data Marker
$styleHeader = [
  'font' => [
      'bold' => true,
  ],

  'borders' => [
      'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      ],
      'left' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      ],
  ],
  'fill' => [
      'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
      'rotation' => 90,
      'startColor' => [
          'argb' => 'FFA0A0A0',
      ],
      'endColor' => [
          'argb' => 'FFFFFFFF',
      ],
  ],
];

$styleQuestion = [
  'borders' => [
      'allBorders'=> [
           'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
       ],
      'outline' => [
           'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
       ],
      'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      ],
      'right' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      ],
      'left' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      ],
      'bottom' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      ],
  ]
];

$worksheet->setCellValue('A11', 'Questions Details ', true);
$worksheet->getStyle('A3')->getFont()->setBold(true);
$worksheet->getStyle('A11')->getFont()->setBold(true);


$cellWorksheet2=2;

$cellNumber=13;

$graph=array();
foreach ($data['surveyQuestions'] as $questionId => $value)
{
    $start=$cellNumber;

    $worksheet->setCellValue('A'.$cellNumber, 'Question ', true);
    $worksheet->setCellValue('B'.$cellNumber, 'Question Type ', true);
    $worksheet->setCellValue('C'.$cellNumber, 'Possible Answer ', true);
    $worksheet->setCellValue('D'.$cellNumber, 'Username ', true);
    $worksheet->setCellValue('E'.$cellNumber, 'Answers ', true);

    if($value[0]['questionType']=="Scale"){
      array_multisort(array_column($value, 'possibleAnswer'), SORT_ASC, $value);
    }


    if($value[0]['questionType']=="FreeText"){
      $worksheet->getStyle('A'.$start.':E'.($cellNumber))->applyFromArray($styleHeader);
    }
    else
    {
      $worksheet2->setCellValue('A'.$cellWorksheet2, $value[0]['question'], true);
      $worksheet->getStyle('A'.$start.':D'.($cellNumber))->applyFromArray($styleHeader);
      //preparing data for graph
      $numdata=count($data['surveyQuestions'][$questionId]);
      $val['dataSeriesLabels']=$wok2Name.'!$A$'.$cellWorksheet2;
      //x-axis values
      $val["xAxisTickValues"]=$wok2Name.'!$B$'.$cellWorksheet2.':$B$'.($cellWorksheet2+$numdata-1);
      //y-axis values
      $val["dataSeriesValues"]=$wok2Name.'!$C$'.$cellWorksheet2.':$C$'.($cellWorksheet2+$numdata-1);
      $val['numdata']=$numdata;
      $val['title']="Question : " .$value[0]['question'];
      $val['plotType']='TYPE_BARCHART';
      $val['plotGrouping']='GROUPING_STACKED';
      $val['yAxisLabel']=new Title('Number of Response');
      $val['xAxisLabel']=new Title("Scale");

      if($value[0]['questionType']=="Choice")
      {
        $val['plotType']='TYPE_PIECHART';
        $val['plotGrouping']=null;
        $val['yAxisLabel']=null;
        $val['xAxisLabel']=null;
      }



    }

    $cellNumber++;

    $freetext=true;

    $worksheet->setCellValue('A'.$cellNumber, $value[0]['question'], true);
    $worksheet->setCellValue('B'.$cellNumber, $value[0]['questionType'], true);

    foreach ($value as $valueId => $details)
    {

      //freetext
      if($value[$valueId]['possibleAnswer']=="")
      {
          $users=explode(",",$value[$valueId]['username']);
          $answer=explode("|",$value[$valueId]['answers']);
          foreach ($answer as $key => $valuess)
          {
            $worksheet->setCellValue('D'.$cellNumber, $users[$key], true);
            $worksheet->setCellValue('E'.$cellNumber, $valuess, true);
            $cellNumber++;
          }
      }
      else // scale and choice
      {


        $worksheet2->setCellValue('B'.$cellWorksheet2, $value[$valueId]['possibleAnswer'], true);

        $freetext=false;
        $worksheet->setCellValue('E'.($start),'');

        $worksheet->setCellValue('C'.$cellNumber, $value[$valueId]['possibleAnswer'], true);
        $users=array();
        if($value[$valueId]['username']=="")
        {
          $cellNumber++;
        }
        else{

            $users=explode(",",$value[$valueId]['username']);
          foreach ($users as $key => $valuess) {
            $worksheet->setCellValue('D'.$cellNumber, $valuess, true);

            $cellNumber++;
          }
        }

        $worksheet2->setCellValue('C'.$cellWorksheet2, COUNT($users), true);
        $cellWorksheet2++;

      }
    }

    if($freetext)
    {
      $worksheet->getStyle('A'.$start.':E'.($cellNumber-1))->applyFromArray($styleQuestion);
      $cellNumber++;

    }
    else
    {
      $worksheet->getStyle('A'.$start.':D'.($cellNumber-1))->applyFromArray($styleQuestion);
      $cellNumber++;
      $val['setTopLeftPosition']="A".$cellNumber;
      $val['setBottomRightPosition']="E".($cellNumber+15);

        $cellNumber=$cellNumber+16;

        $graph[]=$val;
    }

    $cellWorksheet2++;
      $cellNumber++;

}
// echo "<pre>";
// print_r($graph);
// echo "</pre>";

foreach ($graph as $key => $val) {

  $dataSeriesLabels = [
      new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $val['dataSeriesLabels'], null, 1), // 2011
  ];


  // Set the X-Axis Labels
  //     Datatype
  //     Cell reference for data
  //     Format Code
  //     Number of datapoints in series
  //     Data values
  //     Data Marker

  $numdata=$val['numdata'];


  $xAxisTickValues = [
      new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING,   $val["xAxisTickValues"] , null, $numdata), // Q1 to Q4
  ];
  // Set the Data values for each data series we want to plot
  //     Datatype
  //     Cell reference for data
  //     Format Code
  //     Number of datapoints in series
  //     Data values
  //     Data Marker


  $dataSeriesValues = [
      new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $val["dataSeriesValues"], null, $numdata)
  ];
  $legend = new Legend(Legend::POSITION_RIGHT, null, false);
  // Build the dataseries
  if($val['plotType']=="TYPE_BARCHART")
  {
    $series = new DataSeries(
        DataSeries::TYPE_BARCHART, // plotType
        DataSeries::GROUPING_STACKED, // plotGrouping
        range(0, count($dataSeriesValues) - 1), // plotOrder
        $dataSeriesLabels, // plotLabel
        $xAxisTickValues, // plotCategory
        $dataSeriesValues        // plotValues
    );
    $layout1 = new Layout();
    $legend=null;

  }
  else{
    $series = new DataSeries(
        DataSeries::TYPE_PIECHART, // plotType
        null, // plotGrouping
        range(0, count($dataSeriesValues) - 1), // plotOrder
        $dataSeriesLabels, // plotLabel
        $xAxisTickValues, // plotCategory
        $dataSeriesValues        // plotValues
    );
    $layout1 = new Layout();
    // $layout1->setShowVal(true);
    $layout1->setShowCatName(true);
    $layout1->setShowPercent(true);
    $layout1->setShowBubbleSize(true);
  }

  // Set additional dataseries parameters
  //     Make it a horizontal bar rather than a vertical column graph
  // $series->setPlotDirection(DataSeries::DIRECTION_BAR);

  // Set the series in the plot area
  $plotArea = new PlotArea($layout1, [$series]);
  // Set the chart legend


  $title = new Title($val['title']);
  $yAxisLabel = new Title('Number of Response');
  $xAxisLabel = new Title("Scale");
  // Create the chart
  $chart = new Chart(
      'chart1', // name
      $title, // title
      $legend, // legend
      $plotArea, // plotArea
      true, // plotVisibleOnly
      0, // displayBlanksAs
      $val['xAxisLabel'], // xAxisLabel
      $val['yAxisLabel']  // yAxisLabel
  );



  // Set the position where the chart should appear in the worksheet
  $chart->setTopLeftPosition($val['setTopLeftPosition']);
  $chart->setBottomRightPosition($val['setBottomRightPosition']);

  // Add the chart to the worksheet
  $worksheet->addChart($chart);

}

$worksheet->setShowGridlines(true );
$worksheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
$spreadsheet->getActiveSheet()->getPageSetup()->setFitToPage(true);

// // Save Excel 2007 file
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

$date = date('Y-m-d');
$filename = 'survey_'.$data['surveyDetails'][0]['surveyName'].'_'.$date.'.xlsx';
$writer->setIncludeCharts(true);
$writer->save($filename);

header('Content-disposition: attachment; filename='.$filename);
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-type: application/pdf');

header('Content-Length: ' . filesize($filename));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_clean();
flush();
readfile($filename);
unlink($filename);
