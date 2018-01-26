<?php
include '../db.inc.php';

class PatientUpdate
{	
	public $Patient;
	function SelectPatientAMBKART($linkBood){

		//echo $_GET['ambkart'];
		$sql =  "SELECT * FROM KARTOTEK  WHERE AN_AMBKART='".$_GET['ambkart']."' ";
		if ($result = mysqli_query($linkBood, $sql))
			{

		        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
		           $this->Patient = mysqli_fetch_array($result); 
		    	} 
		    /*	echo $Patient['AN_AMBKART'];
		    	echo $Patient['K_NAME'];
		    	echo $Patient['K_IMYA'];
		    	echo $Patient['K_OTCH'];
		    */
			}
	}
	function Update($link){
		
			$sql =  "UPDATE DICOM_STUDYES  SET 
			AN_AMBKART= '".$this->Patient['AN_AMBKART']."',
			K_NAME_RUS= '".$this->Patient['K_NAME']."',
			K_IMYA_RUS= '".$this->Patient['K_IMYA']."',
			K_OTCH_RUS= '".$this->Patient['K_OTCH']."',
			TIME_UPDATE= NOW(),
			SESSION_UPDATE= '".$_SESSION['user_id']."'
			WHERE DICOM_STUDYES.UID='".$_GET['uid']."' ";
			if ($result = mysqli_query($link, $sql))
			{	
				$ViewUpdate = $this->Patient['K_NAME'].' '.$this->Patient['K_IMYA'].' '.$this->Patient['K_OTCH'];
				include 'ViewUpdate.php';
			}
			else
			{	
				$error = "Ошибка! Обновление в базе данных не было произведено";
				include 'ViewError.php';
			}
			

	}
	
}
?>