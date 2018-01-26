<!DOCTYPE html>
<html>
<head>
	<title>Patients</title>		
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/style.css"/>
	<link type="text/css" href="/css/themename/jquery-ui.min.css" rel="stylesheet" />
	<style type="text/css">
		div{
			width: 100%;
    		position: relative;
    		top: 0;
    		left: 0;
    		display: flex;
    		align-items: center;
    		justify-content: center; 
    		overflow: auto;
		}
	</style>
</head>
<body>
	
		<div>
		 <img src="/img/Dicom.png" width="100%" />
		</div>
		<div style="margin: 10px;">
		<form name="patientdata" method="get" >
   			<p>Выберите дату: <input type="date" name="calendar" style="font-size: 15px; padding: 5px;">
   			<input class="ui-button ui-widget ui-corner-all" type="submit"  value="Поиск" ></p>
		</form>
		</div>
		
			<ol class="border">
				<li>Для поиска выберите дату когда было сделано иследование</li>
				<li>Выберите нужного пациента</li>
				<li>Скачивайте и просматривайте снимки у пациентов с привязанной карточкой</li>
				<li>Если иследование не привязано к амбулаторной карточки пациента его можно вручную прикрепить написав ФИО или нормер карточки пациента</li>
			</ol>
			
		
		
		
		


						
</body>
</html>