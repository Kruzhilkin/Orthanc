<?php
class Patient
{
	public $PatientInfo;
	function setPatientRow($arg)
	{
		$this->PatientInfo = $arg;
		//echo $arg['NAME_ORTHANC'];
	}

	function setPatientUID($UID, $link)
	{
		$sql =  "SELECT *,DICOM_STUDYES.UID as DICOM_STUDYES_UID, DICOM_SERIES.UID as DICOM_SERIES_UID  FROM DICOM_STUDYES   LEFT JOIN DICOM_SERIES ON DICOM_STUDYES.UID=DICOM_SERIES.STUDYES_ID  WHERE DICOM_STUDYES.UID='".$UID."' ";
			if ($result = mysqli_query($link, $sql))
			{
				$this->PatientInfo = mysqli_fetch_array($result);
			}
			
		//echo $arg['NAME_ORTHANC'];
	}
	function getPatient()
	{
		return $this->PatientInfo;
	}

	function displayPatient()
	{
		include'ViewPatientMore.php';
		//echo $this->PatientInfo['UID'];
	
		
	}



}