<?php
//include 'db.inc.php';


class PatientsList{
	public $PatientsList;

	//Выбрать всех пациентов
	function SelectPatients($link){
		
		$sql =  "SELECT * FROM DICOM_STUDYES  WHERE AN_AMBKART='' GROUP BY STUDY_DATE";
		if ($result = mysqli_query($link, $sql))
			{

		        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
		           $this->PatientsList[] = mysqli_fetch_array($result);  
		            	/*echo "<br>";
						echo $this->PatientsList[$i]['NAME_ORTHANC'];
						*/
		    	} 
		    	
			}
	}

	function displayViewDate(){
		include 'ViewPatientsDate.php';
	}

    

    //public $Patients;
	function searchPatient($link){
		if ($_GET['calendar'])
		{

			//echo $_GET['calendar'];
			$sql =  "SELECT * FROM DICOM_STUDYES  WHERE STUDY_DATE='".$_GET['calendar']."' ";
			if ($result = mysqli_query($link, $sql))
			{

		        for ($i = 0; $i < mysqli_num_rows($result); $i++)
		        {
			     $row = mysqli_fetch_array($result);
			        $this->PatientsList[$row['UID']] = new Patient(); 
			        $this->PatientsList[$row['UID']]->setPatientRow($row);
		            //echo "<br>";
		            //print_r($row);
					//echo $this->Patient[$i]['NAME_ORTHANC'];		
		    	} 
		    	
			}
		}
		//exit();
	}

	function displayPatients()
	{
		include 'ViewPatients.php';
		
	}

    
}






?>
