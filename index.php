<?php
include 'db.inc.php';
  //include 'patients.php';
  include 'series.php';
  
    
  if(!$_GET){

    $a = new PatientsClass();
    $a->setPatients();
    $a->displayPatients();
      
  }


  if($_GET['uid']){ 
    $v = new PatientClass();
    $v -> setPatientFromId($_GET['uid']);
    //$v -> copyPatient($_GET['uid']);
    $v->patientSex();
    $v->patientBirthDate();
    $v->selectUidPatient($link, $_GET['uid']);
    $v-> displayInfo();
   
  /*
    $k = new StudiesClass();
    $k -> setStudies($_GET['uid']);

    $s = new SeriesClass();
    $s -> setSeries($k); 
    $s -> saveStudies();  
  */ 
  }
/*
  if($_GET['uid'] && (isset($but))){
    $s = new Patient();
    $s -> copyPatient($_GET['uid']);
  }
*/
?>

