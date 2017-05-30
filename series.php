<?php

  include 'studies.php';

  class SeriesClass 
  {
    public  $seriesMyOrthanc;
    public $Studies;

    function setSeries(StudiesClass $Studies){

      $this -> Studies = $Studies;

      foreach ($Studies->studiesMyOrthanc as  $seriesPatient) {
       
      $chq = curl_init();
        curl_setopt($chq, CURLOPT_URL, "192.168.1.3:8042/studies/".$seriesPatient);
       // print_r($seriesPatient);
       // print_r($Studies->studiesMyOrthanc) ;
        curl_setopt($chq, CURLOPT_RETURNTRANSFER, true);

        // загрузка страницы и выдача её браузеру
        $resultName = curl_exec($chq);
          
        // завершение сеанса и освобождение ресурсов
        curl_close($chq);

        $cartq = json_decode($resultName, true);
        $this -> seriesMyOrthanc = $cartq['Series'];

    }
   }
   

   function saveStudies(){
    include 'db.inc.php';
    //print_r($this -> seriesMyOrthanc);
    $seriesid = $this -> Studies-> studiesMyOrthanc[0];
    foreach ($this -> seriesMyOrthanc as  $valueSeries) {
      $sql = "INSERT INTO series SET  uid='".$valueSeries."' , studiesid='".$seriesid."' ";
      if ($result = mysqli_query($link, $sql)){
        echo "Series Записано успешно";
        echo "<br>";
        //return true;
      } 
    }
   }
  }
?>