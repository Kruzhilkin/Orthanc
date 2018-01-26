<?php


include '../db.inc.php';
include 'PatientsList.php';
include 'Patient.php';
include 'PatientUpdate.php';

$searchPatient = new PatientsList();
//$searchPatient -> SelectPatients(); //Ввывод всех пациентов 
if (!$_GET['uid'] and !$_GET['calendar']) {
	$searchPatient -> displayViewDate();
}
	


if($_GET['calendar'])
{
	//echo $_GET['calendar'];
	$searchPatient -> searchPatient($link);
	$searchPatient -> displayPatients();
}


if($_GET['uid'])
{
	$Patient = new Patient();
	$Patient -> setPatientUID($_GET['uid'], $link);
	$Patient -> displayPatient();

}

if(isset($_GET['update']))
{
	$update= new PatientUpdate();
	$update->SelectPatientAMBKART($linkBood);
	$update-> Update($link);
	

}






?>
