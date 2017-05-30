<?php

  class PatientsClass
  {
    public $arrayPatients;
    function setPatients()     
    {
     
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "192.168.1.3:8042/patients");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $result_patients = curl_exec($ch);
        
      // завершение сеанса и освобождение ресурсов
      curl_close($ch);

      $cart = json_decode($result_patients, true);

      foreach ($cart as $value) 
      {
        $chq = curl_init();
        curl_setopt($chq, CURLOPT_URL, "192.168.1.3:8042/patients/".$value);
        curl_setopt($chq, CURLOPT_RETURNTRANSFER, true);

        // загрузка страницы и выдача её браузеру
        $resultName = curl_exec($chq);
          
        // завершение сеанса и освобождение ресурсов
        curl_close($chq);

        $cartq = json_decode($resultName, true);
        //print_r($cartq);
        $ww=new PatientClass();
        $ww->setPatientFromArray($cartq);
        $this->arrayPatients[] = $ww;

        
        //echo $cartq['Studies'];
        //echo '<br>';
        //echo $cartq['MainDicomTags']['PatientName'];
       // $patientsMyOrthanc[] = array ('id' => $cartq['ID'], 'name' => $cartq['MainDicomTags']['PatientName']);       
      
      } 

    }
    function displayPatients()
    {
      include 'patientsView.html';
    }
  }

  


  class PatientClass 
  {
    public $patientsMyOrthanc;
    public $sex;
    public $patientBirthDate;
    public $seriesURLarr;
	  public $listPatients;
    
   function setPatientFromArray($arr){
       $this -> setName($arr);

   }

   function getPatients(){
    return $patientsMyOrthanc;
   }

    function setName($b)
    { 
     $this -> patientsMyOrthanc = $b;
 
    }

    function displayInfo()
    {
      include'patientsMore.html';
    }

    function setPatientFromId($id){
        $chq = curl_init();
        $adress = "192.168.1.3:8042/patients/".$id;
        curl_setopt($chq, CURLOPT_URL, $adress);
        curl_setopt($chq, CURLOPT_RETURNTRANSFER, true);

        // загрузка страницы и выдача её браузеру
        $resultName = curl_exec($chq);
          
        // завершение сеанса и освобождение ресурсов
        curl_close($chq);

        $cartq = json_decode($resultName, true);
        $this->setName($cartq);
    }

    function patientSex(){
      if($this-> patientsMyOrthanc['MainDicomTags']['PatientSex'] == "F")
        $this-> sex = "женский";
      else
        $this-> sex = "мужской";
    }

    function patientBirthDate(){
      $this -> patientBirthDate = date("d-m-Y", strtotime($this-> patientsMyOrthanc['MainDicomTags']['PatientBirthDate']));

    }

    function copyPatient($id){

      //Копирование панцента из 192.168.1.3 в 192.168.1.196(OrthancServer1)
      $ch = curl_init();
      $adress = "192.168.1.3:8042/modalities/OrthancServer1/store";
        curl_setopt($ch, CURLOPT_URL, $adress); 
        curl_setopt($ch, CURLOPT_POST, $true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $id);  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       $result_patients = curl_exec($ch);
          
      // завершение сеанса и освобождение ресурсов
      curl_close($ch);

      $cart = json_decode($result_patients, true);
      return true;
      //echo $id; 
      //echo $adress;
      //echo "<br>";
      //echo $cart;
    }


    function deletePatient($id){

      //Удаление пациента из 192.168.1.3
      $ch = curl_init();
      $adress = "192.168.1.3:8042/patients/".$id;
        curl_setopt($ch, CURLOPT_URL, $adress); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        echo $result_patients = curl_exec($ch);
        
        // завершение сеанса и освобождение ресурсов
        curl_close($ch);

      $cart = json_decode($result_patients, true);
      return true;
      //$a[] = array ('id' => $cart['ID']);
      //echo $adress;
      //echo "<br>";
      //print_r ($cart);

    }


     function bdInsertPatient($link, $uid, $ambkart){

      //include 'db.inc.php';
      
      $name = $this-> patientsMyOrthanc['MainDicomTags']['PatientName'];
      //$uid = $this-> patientsMyOrthanc['ID'];
        //echo $_GET["name"];
        //echo $_GET["uid"];
      $sql = "INSERT INTO patients SET name='".$name."', uid='".$uid."' , AN_AMBKART='".$ambkart."' ";
      if ($result = mysqli_query($link, $sql)){
        echo "Записано успешно";
        echo "<br>";
        return true;
      } 
      //$stmt = $mysqli->prepare($sql); 
      //$stmt->bind_param('sssd', $name, $language, $official, $percent); 

      /* выполнение подготовленного выражения  */ 
      //$stmt->execute(); 
      /* Закрытие соединения и выражения*/ 
      //$stmt->close(); 
      }

      function selectUidPatient($link, $uid){

          $sql = "SELECT * FROM patients LEFT JOIN studies ON patientsid = patients.uid LEFT JOIN series ON studiesid = studies.uid WHERE patients.uid = '$uid'";
           // echo "$uid";
         if($result = mysqli_query($link, $sql)){
          for ($i = 0; $i < mysqli_num_rows($result); $i++) {
           // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $this -> seriesURLarr[] = mysqli_fetch_array($result);
           // printf ($this -> seriesURLarr["uid"]);
           // echo "<br>";
          }    
         }
         
      }
	  /*
	  function listPatients($linkBood){
		  
		  $sql = "SELECT K_NAME FROM KARTOTEK";
		  
		  if($result = mysqli_query($linkBood, $sql)){
			  
			  $this -> listPatients[] = mysqli_fetch_array($result);
			   printf ($this -> listPatients);
		  }
		  
	  }*/
	  

      

  }


  
?>