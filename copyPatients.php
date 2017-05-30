<?php
ob_start();

//include 'patients.php';
include 'db.inc.php';
//include 'studies.php';
include 'series.php';
  

  if($_GET['uid']){
    $patient = new PatientClass();
    $patient -> setPatientFromId($_GET['uid']);
   if($patient -> copyPatient($_GET['uid']))
    echo "Копирование завершено успешно!";
	echo "<br>";
 
   
    if($patient -> bdInsertPatient($link, $_GET['uid'], $_GET['ambkart']))

    //if($p; -> deletePatient($_GET['uid']))
    echo "Удаление завершено успешно!";


	$studies = new StudiesClass();
    $studies -> setStudies($_GET['uid']);
    $studies -> saveStudies();

    $series = new SeriesClass();
    $series -> setSeries($studies);
    $series -> saveStudies();

   
  }
  

  //sleep(5);
  header('refresh: 4; url=index.php');
  //exit();

?>

