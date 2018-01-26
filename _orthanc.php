<?php
include 'db.inc.php';



    $sql = "TRUNCATE TABLE  DICOM_STUDYES";

      if ($result = mysqli_query($link, $sql))
        echo "Очищено";
       else
        echo "НЕ Очищено";

    $sql = "TRUNCATE TABLE  DICOM_SERIES";


      if ($result = mysqli_query($link, $sql))
        echo "Очищено";
       else
        echo "НЕ Очищено";

    $sql = "TRUNCATE TABLE  DICOM_PATIENTS";


      if ($result = mysqli_query($link, $sql))
        echo "Очищено";
       else
        echo "НЕ Очищено";



	$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/patients");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//echo $arrayPatient->MainDicomTags->PatientID.   $arrayPatient->MainDicomTags->PatientBirthDate;
      $result = curl_exec($ch);
        
      // завершение сеанса и освобождение ресурсов
    curl_close($ch);
    echo"<pre>";
 		print_r    ( $listPatientOrthanc = json_decode($result, true));
	echo"</pre>";


$count = 0;
foreach ($listPatientOrthanc as $parientID) {
	
  unset($tagSeriesOrthanc);

	$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/patients/".$parientID);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);   
      // завершение сеанса и освобождение ресурсов
      curl_close($ch);

    echo"<pre>";
 	  print_r( $tagPatientOrthanc = json_decode($result, true));
 	  echo"</pre>";

      foreach ($tagPatientOrthanc['Studies'] as $studies) {
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/studies/".$studies);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $result = curl_exec($ch);   
          // завершение сеанса и освобождение ресурсов
          curl_close($ch);

          echo"<pre>";
        print_r ($tagStudiesOrthanc = json_decode($result, true));
          echo"</pre>";

            foreach ($tagStudiesOrthanc['Series'] as $series) {
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/series/".$series);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $result = curl_exec($ch);   
              // завершение сеанса и освобождение ресурсов
              curl_close($ch);

              echo"<pre>";
         print_r ($tagSeriesOrthanc[] = json_decode($result, true));
              echo"</pre>";
              
            }
      }



   /*
  echo $tagPatientOrthanc['MainDicomTags']['PatientID']; 
  echo "<br>";
  echo $tagPatientOrthanc['MainDicomTags']['PatientBirthDate']; 
  */

    $AN_AMBK = $tagPatientOrthanc['MainDicomTags']['PatientID']+1-1;

   	$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "192.168.1.154/servlet/JsonOrthanc.php?PatientID=".$AN_AMBK."&DB=".$tagPatientOrthanc['MainDicomTags']['PatientBirthDate']);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
      $result = curl_exec($ch);
        
      // завершение сеанса и освобождение ресурсов
      curl_close($ch);
    echo"<pre>";
    print_r($kartatekPatient = json_decode($result, true)) ;
 	echo"</pre>";




  $sql = "INSERT INTO DICOM_STUDYES SET 
     NAME_ORTHANC='".$tagPatientOrthanc['MainDicomTags']['PatientName']."', 
     K_NAME_RUS='".$kartatekPatient[0]['K_NAME']."', 
     K_IMYA_RUS='".$kartatekPatient[0]['K_IMYA']."', 
     K_OTCH_RUS='".$kartatekPatient[0]['K_OTCH']."', 
     BIRTH_DATE='".$tagPatientOrthanc['MainDicomTags']['PatientBirthDate']."', 
     AN_AMBKART='".$kartatekPatient[0]['AN_AMBKART']."',
     AN_AMBKART_ORTHANC='".$tagPatientOrthanc['MainDicomTags']['PatientID']."',
     UID='".$tagStudiesOrthanc['ID']."', 
     PATIENT_ID='".$tagPatientOrthanc['ID']."', 
     STUDY_DATE='".$tagStudiesOrthanc['MainDicomTags']['StudyDate']."', 
     MODALITY='".$tagSeriesOrthanc['MainDicomTags']['Modality']."',
     SERVER_IP='".$_SERVER['REMOTE_ADDR']."',
     INSTITUTION_NAME='".$tagStudiesOrthanc['MainDicomTags']['InstitutionName']."',
     ReferringPhysicianName= '".$tagStudiesOrthanc['MainDicomTags']['ReferringPhysicianName']."' ";
      if ($result = mysqli_query($link, $sql))
        echo "Записано успешно в studies";
        echo "<br>";
        //return true; 
    
  $sql = "INSERT INTO DICOM_PATIENTS SET UID='".$tagPatientOrthanc['ID']."', NAME_ORTHANC='".$tagPatientOrthanc['MainDicomTags']['PatientName']."', AN_AMBKART='".$tagPatientOrthanc['MainDicomTags']['PatientID']."', server_ip='".$_SERVER['REMOTE_ADDR']."'  ";
      if ($result = mysqli_query($link, $sql))
        echo "Записано успешно в patients";
        echo "<br>";
        //return true; 
    
    foreach($tagSeriesOrthanc as $key=>$valueSeries)
    {
      $sql = "INSERT INTO DICOM_SERIES SET 
        UID='".$valueSeries['ID']."', 
        STUDYES_ID='".$valueSeries['ParentStudy']."', 
        MODALITY='".$valueSeries['MainDicomTags']['Modality']."',
        BODY_PART_EXAMINED='".$valueSeries['MainDicomTags']['BodyPartExamined']."',
        MANUFACTURER='".$valueSeries['MainDicomTags']['Manufacturer']."',
        PROTOCOL_NAME='".$valueSeries['MainDicomTags']['ProtocolName']."',
        SERIES_DESCRIPTION='".$valueSeries['MainDicomTags']['SeriesDescription']."',
        STATION_NAME='".$valueSeries['MainDicomTags']['StationName']."' ";
        if ($result = mysqli_query($link, $sql))
        echo "Записано успешно в series";
        echo "<br>";
        //return true; 
    }

$count++;

}

echo $count;

?>