<?php

  include 'patients.php';

  class StudiesClass 
  {
    public  $studiesMyOrthanc;
    public $uidPatient;

    function setStudies($uidPatient){
      $this -> uidPatient = $uidPatient;
      $chq = curl_init();
        curl_setopt($chq, CURLOPT_URL, "192.168.1.3:8042/patients/".$uidPatient);
        curl_setopt($chq, CURLOPT_RETURNTRANSFER, true);
        //echo($uidPatient);
        // загрузка страницы и выдача её браузеру
        $resultName = curl_exec($chq);
          
        // завершение сеанса и освобождение ресурсов
        curl_close($chq);

        $cartq = json_decode($resultName, true);
        $this -> studiesMyOrthanc = $cartq['Studies'];
   }
   

   function saveStudies(){
    include 'db.inc.php';
    //printf($this -> studiesMyOrthanc);
    foreach ($this -> studiesMyOrthanc as  $valueStadies) {
      $sql = "INSERT INTO studies SET  uid='".$valueStadies."' , patientsid='".$this -> uidPatient."' ";
      if ($result = mysqli_query($link, $sql)){
        echo "<br>";
        echo "Stadies Записано успешно";
        echo "<br>";
        //return true;
      } 
    }
   }
  }
?>