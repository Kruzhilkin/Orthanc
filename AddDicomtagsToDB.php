<?php

include 'db.inc.php';
/*
if($_GET)
{
	$file = 'people.txt';
	$fp = fopen($file, 'a+');
	$save = "\r\n"."\r\n"."REMOTE_ADDR=".$_SERVER['REMOTE_ADDR']."\r\n"."DATETIME=".date("Y-m-d H:i:s")."\r\n";
	
		foreach ($_GET as $key=>$value)
		{
			$save.=$key.'='.$value."\r\n";
			
		}
	fwrite($fp,$save);
	fclose($fp);

}

*/

function getStudy($value)     
    {
     
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/studies/".$value);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $result_Study = curl_exec($ch);
        
      // завершение сеанса и освобождение ресурсов
      curl_close($ch);

      $result = json_decode($result_Study);
	  return $result;
	  
	  
      
     }
	  
function getPatient($value)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/patients/".$value->ParentPatient);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      	$result_Parient = curl_exec($ch);
        
      	// завершение сеанса и освобождение ресурсов
      	curl_close($ch);
		$result = json_decode($result_Parient);
		return $result;
	}
	
	
function getSeries($value)
	{
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/series/".$value);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      	$result_Parient = curl_exec($ch);
        
      	// завершение сеанса и освобождение ресурсов
      	curl_close($ch);
		$result = json_decode($result_Parient);
		return $result;
	}
	

$arrayStudy=getStudy($_GET['studyId']);
echo'<pre>';
	   print_r($arrayStudy);
echo'</pre>';

$arrayPatient=getPatient($arrayStudy);
echo'<pre>';
	   print_r($arrayPatient);
echo'</pre>';

foreach($arrayStudy->Series as $key=>$value)
{
	$arraySeries[]=getSeries($value);	
	
}
	echo'<pre>';
	print_r($arraySeries);
	echo'</pre>';


	$AN_AMBK = $arrayPatient->MainDicomTags->PatientID+1-1;

	  $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "192.168.1.154/servlet/JsonOrthanc.php?PatientID=".$AN_AMBK."&DB=".$arrayPatient->MainDicomTags->PatientBirthDate);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//echo $arrayPatient->MainDicomTags->PatientID.   $arrayPatient->MainDicomTags->PatientBirthDate;
      $result = curl_exec($ch);
        
      // завершение сеанса и освобождение ресурсов
      curl_close($ch);
    echo"<pre>";
 		print_r    ( $kartatekPatient = json_decode($result, true));
 	echo"</pre>";



 echo	$sql = "INSERT INTO DICOM_STUDYES SET 
		NAME_ORTHANC='".$arrayStudy->PatientMainDicomTags->PatientName."', 
		K_NAME_RUS='".$kartatekPatient[0]['K_NAME']."', 
		K_IMYA_RUS='".$kartatekPatient[0]['K_IMYA']."', 
		K_OTCH_RUS='".$kartatekPatient[0]['K_OTCH']."', 
		BIRTH_DATE='".$arrayStudy->PatientMainDicomTags->PatientBirthDate."', 
		AN_AMBKART='".$kartatekPatient[0]['AN_AMBKART']."',
		AN_AMBKART_ORTHANC='".$arrayPatient->MainDicomTags->PatientID."',
		UID='".$arrayStudy->ID."', 
		PATIENT_ID='".$arrayStudy->ParentPatient."', 
		STUDY_DATE='".$arrayStudy->MainDicomTags->StudyDate."', 
		MODALITY='".$arraySeries[0]->MainDicomTags->Modality."',
		SERVER_IP='".$_SERVER['REMOTE_ADDR']."' ,
		INSTITUTION_NAME='".$arrayStudy->MainDicomTags->InstitutionName."',
     	ReferringPhysicianName= '".$arrayStudy->MainDicomTags->ReferringPhysicianName."' ";
      if ($result = mysqli_query($link, $sql))
        echo "Записано успешно в studies";
        echo "<br>";
        //return true; 
		
	$sql = "INSERT INTO DICOM_PATIENTS SET UID='".$arrayPatient->ID."', NAME_ORTHANC='".$arrayPatient->MainDicomTags->PatientName."', AN_AMBKART='".$arrayPatient->MainDicomTags->PatientID."', server_ip='".$_SERVER['REMOTE_ADDR']."'  ";
      if ($result = mysqli_query($link, $sql))
        echo "Записано успешно в patients";
        echo "<br>";
        //return true; 
		
		foreach($arraySeries as $key=>$valueSeries)
		{
			$sql = "INSERT INTO DICOM_SERIES SET 
				UID='".$valueSeries->ID."', 
				STUDYES_ID='".$valueSeries->ParentStudy."', 
				MODALITY='".$valueSeries->MainDicomTags->Modality."',
				BODY_PART_EXAMINED='".$valueSeries->MainDicomTags->BodyPartExamined."',
       			MANUFACTURER='".$valueSeries->MainDicomTags->Manufacturer."',
        		PROTOCOL_NAME='".$valueSeries->MainDicomTags->ProtocolName."',
        		SERIES_DESCRIPTION='".$valueSeries->MainDicomTags->SeriesDescription."',
        		STATION_NAME='".$valueSeries->MainDicomTags->StationName."' ";
			  if ($result = mysqli_query($link, $sql))
				echo "Записано успешно в series";
				echo "<br>";
				//return true; 
		}
		

/* проверка таблицы на наличие дубликатов
SELECT * , COUNT( * ) AS s
FROM  `DICOM_PATIENTS` 
GROUP BY UID
HAVING s >1
LIMIT 0 , 50
*/

/*    удаление дубликатов в таблице
CREATE TEMPORARY TABLE  `DICOM_PATIENTS_temp` AS (
SELECT MIN( id ) AS id
FROM  `DICOM_PATIENTS` 
GROUP BY UID
);
DELETE FROM  `DICOM_PATIENTS` WHERE  `DICOM_PATIENTS`.id NOT IN (
SELECT id
FROM DICOM_PATIENTS_temp
);
*/
?>

