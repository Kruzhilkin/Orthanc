<?php
       if (isDomainAvailible('192.168.1.3:8042'))
       {
             //  echo "Работает";
       }
       else
       {
               echo "Ой, сайт не доступен.";
       }

       //Возвращает true, если домен доступен
       function isDomainAvailible($domain)
       {
               //Проверка на правильность URL 
             /*  if(!filter_var($domain, FILTER_VALIDATE_URL))
               {
                       return false;
               }
			*/
               //Инициализация curl
               $curlInit = curl_init($domain);
               curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
               curl_setopt($curlInit,CURLOPT_HEADER,true);
               curl_setopt($curlInit,CURLOPT_NOBODY,true);
               curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

               //Получаем ответ
               $response = curl_exec($curlInit);

               curl_close($curlInit);

               if ($response) return true;

               return false;
       }

//include $_SERVER ['DOCUMENT_ROOT' ] . '/tviti/db.inc.php' ; //Подключение к БД
  

  //Вывести патиентов из 192.168.1.3    
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
		
		//echo $cartq['ID'];
		//echo $cartq['MainDicomTags']['PatientName'];
		$patientsMyOrthanc[] = array ('id' => $cartq['ID'], 'name' => $cartq['MainDicomTags']['PatientName']);        
    

     
	}

  //include 'form.html.php';
  //exit();

  echo "<br>";
  echo "<br>";


/*
  //Изменение параметров у пацента 
  
  $ch = curl_init();

  $adress = "192.168.1.3:8042/patients/53a93428-ed356546-dd713e3a-f5ca5894-ba9914f6/modify";
    curl_setopt($ch, CURLOPT_URL, $adress); 
    curl_setopt($ch, CURLOPT_POST, $true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"Replace\":{\"PatientID\":\"Hefl8lo\",\"PatientName\":\"АША\"}}");  

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   echo $result_patients = curl_exec($ch);
    
    // завершение сеанса и освобождение ресурсов
  curl_close($ch);

  $cart = json_decode($result_patients, true);
  
  echo $adress;
  echo "<br>";
  print_r($cart) ;
 */ 

  echo "<br>";
  echo "<br>";

/*
  //Копирование панцента из 192.168.1.3 в 192.168.1.196(OrthancServer1)
  $ch = curl_init();
    $adress = "192.168.1.3:8042/modalities/OrthancServer1/store";
    curl_setopt($ch, CURLOPT_URL, $adress); 
    curl_setopt($ch, CURLOPT_POST, $true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, '5bbea45e-2ad8af93-2741362b-e22356b7-45d04337');  

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    echo $result_patients = curl_exec($ch);
        
    // завершение сеанса и освобождение ресурсов
    curl_close($ch);

    $cart = json_decode($result_patients, true);
      
    echo $adress;
    echo "<br>";
    echo $cart;
      
*/

  echo "<br>";
  echo "<br>";


/*

  //Вывести патиентов из 192.168.1.196
  $ch = curl_init();


  curl_setopt($ch, CURLOPT_URL, "192.168.1.196:8042/patients");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $result_patients = curl_exec($ch);
    
  // завершение сеанса и освобождение ресурсов
  curl_close($ch);

  $cart = json_decode($result_patients, true);

  foreach ($cart as $value) 
  {
    $chq = curl_init();

      curl_setopt($chq, CURLOPT_URL, "192.168.1.196:8042/patients/".$value);
      curl_setopt($chq, CURLOPT_RETURNTRANSFER, true);


    // загрузка страницы и выдача её браузеру
    $resultName = curl_exec($chq);
      
    // завершение сеанса и освобождение ресурсов
    curl_close($chq);

    $cartq = json_decode($resultName, true);

    
    echo '<div class = "Item">';    
    echo $cartq['ID'];
    echo $cartq['MainDicomTags']['PatientName'];
    echo '</div>';
    
   
    $patients[] = array ('id' => $cartq['ID'], 'name' => $cartq['MainDicomTags']['PatientName']);        
    

     
  }

*/

echo "<br>";
echo "<br>";



  /*
  //Удаление пациента из 192.168.1.3
  $ch = curl_init();
  $adress = "192.168.1.3:8042/patients/34ce0e89-6cd30ca5-8c80991b-1ebc0f18-918a9426";
    curl_setopt($ch, CURLOPT_URL, $adress); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
     

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    echo $result_patients = curl_exec($ch);
    
    // завершение сеанса и освобождение ресурсов
    curl_close($ch);

  $cart = json_decode($result_patients, true);
  //$a[] = array ('id' => $cart['ID']);
  echo $adress;
  echo "<br>";
  print_r ($cart);


  echo "<br>";
  echo "<br>";
*/

  //Вывести патиентов из 192.168.1.3    
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

    
    echo '<div class = "Item">';    
    echo $cartq['ID'];
    echo $cartq['MainDicomTags']['PatientName'];
    echo '</div>';
    
   
    $patients[] = array ('id' => $cartq['ID'], 'name' => $cartq['MainDicomTags']['PatientName']);        
    

     
  }



?>