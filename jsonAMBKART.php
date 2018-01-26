<?php 
session_start();
// проверить права доступа к картоткек!



//echo '["'.$_GET['term'].'-1"]';exit;
$sParam = trim($_GET['term']); // Выход по чтению внешних данных
if (preg_match("/^[0-9]{1,7}$/",$sParam))
		{
		$sql="select * 
			from 
			 KARTOTEK   
			where 
			 AN_AMBKART like '".$sParam."%' 
			  limit 10";
		}
elseif (preg_match("/([а-Я]| ){1,70}/",$sParam))
		{
		$fio=explode(" ",$sParam);
			
		$sql="select  
				*
			from 
			 KARTOTEK 
			where ";
			 $sql.="KARTOTEK.K_NAME like '".$fio[0]."%' ";
			 		if ($fio[1])$sql.=" and KARTOTEK.K_IMYA like '".$fio[1]."%' ";
			 		if ($fio[2])$sql.=" and KARTOTEK.K_OTCH like '".$fio[2]."%' ";
			if ($_GET['FilterActivePacient'] or $_GET['FilterClosePacient'] or $_GET['FilterDeadPacient'] or $_GET['FilterAttachPacient'])
			{
			$sql.=" and ( 0 ";
					if ($_GET['FilterActivePacient']=='true')$sql.=" or KARTOTEK.K_DELUCHET_COUSE is null  ";
					if ($_GET['FilterClosePacient']=='true')$sql.=" or KARTOTEK.K_DELUCHET_COUSE=1  ";
					if ($_GET['FilterDeadPacient']=='true')$sql.=" or KARTOTEK.K_DELUCHET_COUSE=2  ";
					if ($_GET['FilterAttachPacient']=='true')$sql.=" or KARTOTEK.K_DELUCHET_COUSE=5  ";
			  
			  $sql.=" )";
			}
			/*else
			{$sql.=" and  KARTOTEK.K_DELUCHET_COUSE is null  ";}*/
			  
			   $sql.=" limit 10";
			  //echo '<br/>'.$sql.'<br/>';
		}
else exit;	
if (!$sParam) {return false;exit;}
 // Используем базу данных как источник данных
	include 'db.inc.php';
     if ($sParam)
	 {
	 	 $result_base=mysqli_query($linkBood, $sql);
		 if (!$result_base){echo "Нет результата"; 
		 echo $sql;exit;}
		 else
		 {$count_base=mysqli_num_rows($result_base);  }
 	echo '[';
	
	for ($i=0;$i<$count_base;$i++)
	{
		
 	$row_base=mysqli_fetch_array($result_base);
      echo '{"label":"'.$row_base['K_NAME'] ." ".$row_base['K_IMYA'].' '.$row_base['K_OTCH'].' '.$row_base['K_BITHDAY'].'","value":"'.$row_base['K_NAME'] ." ".$row_base['K_IMYA']. " ".$row_base['K_OTCH'].'","AN_AMBKART":"'.$row_base['AN_AMBKART'].'","K_SOATO":"'.$row_base['K_SOATO'].'","K_TERCODEN":"'.$row_base['K_TERCODEN'].'","K_BITHDAY":"'.date("d-m-Y",strtotime($row_base['K_BITHDAY'])).'","K_ADDRESS":"'.addslashes($row_base['K_ADDRESS_2']).'","K_LPUMP":"'.$row_base['K_LPUMP'].'","K_LPUMP_TX":"'.$row_base['K_LPUMP_TX'].'","K_SEX":"'.$row_base['K_SEX'].'","K_AGE":"'.$row_base['K_AGE'].'","K_DEAD":"'.$row_base['K_DEAD'].'","K_DEAD_DATE":"'.$row_base['K_DEAD_DATE'].'","K_DELUCHET":"'.$row_base['K_DELUCHET'].'","K_DELUCHET_COUSE":"'.$row_base['K_DELUCHET_COUSE'].'","K_DISTRICT_7":"'.$row_base['NameDistrict'].'"}';
	  if ($i!=$count_base-1) echo ',';
	   // echo '<div style="height:14px"><div style=" width:80%; float:left;"><img src="../../images/navigation1/WebIcons7/(00,34).png"/>'.$row_base['AN_AMBKART']." ".$row_base['K_NAME'] ." ".$row_base['K_IMYA']. " ".$row_base['K_OTCH']. '</div>		<div align="right"style=" width:20%; float:left;">'.$row_base['K_BITHDAY'].'</div></div>		<div align="left" style=" font-size:10px">Адрес: sdfsdfsdf</div>'."\n";
	}
	
	echo ']';
	}
	exit;	
       
