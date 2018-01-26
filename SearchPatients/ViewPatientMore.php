<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/style.css"/>
	<link type="text/css" href="/css/themename/jquery-ui.min.css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script>
	  $( function() { 
	    $( ".ui-autocomplete-input" ).autocomplete({
	      source: "/jsonAMBKART.php",
		  minLength: 2,
		  select: function(event, ui) {
	            $('#ambkart-input').val([ui.item.AN_AMBKART]);
	        }
	    });
	  } );
    </script>
</head>
<body>
	<div id="main">
		<div  class="ui-dialog-titlebar ui-corner-all ui-widget-header ui-helper-clearfix ui-draggable-handle patientView">
			<?php  if (empty($this->PatientInfo['AN_AMBKART'])) { ?>
			<form action='' method="GET">
				<input type="text" name="name" class="ui-autocomplete-input" title="Введите ФИО пациента или номер карточки">
	            <input type="text" name="ambkart" id="ambkart-input" style="display: none;">
				<input type="text" name="uid" value="<?php echo  $_GET['uid']; ?>"  style="display: none;">
				<input type="submit" name=update class="ui-button ui-corner-all ui-widget" value="Обновить">
			</form>
			<?php }   ?>

			<p>ФИО: 
				<?php
					echo $this->PatientInfo['NAME_ORTHANC'];
				?>
			</p>
			<p>Дата рождения: 
				<?php
					echo $this->PatientInfo['BIRTH_DATE'];
				?>
			</p>
			<p>Тип исследования: 
				<?php
					echo $this->PatientInfo['MODALITY'];
				?>
			</p>
			<p>Дата проведения исследования: 
				<?php
					echo $this->PatientInfo['STUDY_DATE'];
				?>
			</p>

			<a href="http://<?php echo $this->PatientInfo['SERVER_IP']?>:8042/web-viewer/app/viewer.html?series=<?php echo $this->PatientInfo['DICOM_SERIES_UID']?>"target='new'><div class="ui-button ui-corner-all ui-widget">Смотреть снимок</div>
			</a>

			<a href="http://<?php echo $this->PatientInfo['SERVER_IP']?>:8042//series/<?php echo $this->PatientInfo['DICOM_SERIES_UID']?>/archive"target='new'><div class="ui-button ui-corner-all ui-widget">Скачать</div></a>
						
		</div>
	</div>
</body>
</html>

