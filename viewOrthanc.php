<?php
include 'db.inc.php';

if ($_GET['AN_AMBKART'])
{
	/*
	$sql =  "SELECT * FROM DICOM_STUDYES WHERE DICOM_STUDYES.AN_AMBKART='".$_GET['AN_AMBKART']."' LIMIT 1";

	if ($result = mysqli_query($link, $sql))
	{

       // for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $resServer = mysqli_fetch_array($result);  

    //	} 
    	print_r ($resServer);
	}
	*/
	$sql =  "SELECT * FROM DICOM_SERIES  LEFT JOIN DICOM_STUDYES ON DICOM_SERIES.STUDYES_ID = DICOM_STUDYES.UID  WHERE DICOM_STUDYES.AN_AMBKART='".$_GET['AN_AMBKART']."' GROUP BY STUDY_DATE";
	if ($result = mysqli_query($link, $sql))
		{

	        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
	            $resUID = mysqli_fetch_array($result);  
	            echo "<br>";
					$link = 'http://'.$resUID['SERVER_IP'].':8042/web-viewer/app/viewer.html?series='.$resUID['1'] ;
				echo "<a href='".$link."'target='new'>Ссылка на просмотр за ".$resUID['STUDY_DATE']."</a>";
				echo "<br>";
					$link2 = 'http://'.$resUID['SERVER_IP'].':8042/series/'.$resUID['1'].'/archive';
				echo "<a href='".$link2."'target='new'>Ссылка на скачиваине</a>";


	    	} 
	    	//print_r ($resUID);
		}

}


?>