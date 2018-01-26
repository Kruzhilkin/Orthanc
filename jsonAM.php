<?php
	include 'db.inc.php';
	
	/*$flowers = array("Астра", "Нарцисс", "Роза", "Пион", "Примула",
			      "Подснежник", "Мак", "Первоцвет", "Петуния", "Фиалка");
	*/
	if (!empty($_GET['term']))       
    {
		
        $term = $_GET['term'];
		
		 $sql = "SELECT * FROM KARTOTEK WHERE K_NAME LIKE '%".$term."%'";
		  
		  while($result = mysqli_query($linkBood, $sql)){
			  
			  $listPatients[] = mysqli_fetch_array($result);
			   //printf ($this -> listPatients);
		  }
		
		// Шаблон рег. выражения
		$pattern = '/^'.preg_quote($term).'/iu';
		
		echo json_encode(preg_grep($pattern, $listPatients));
    }
	
?>