<!DOCTYPE html>
<html>
<head>
	<title>Обнавление</title>
	<link rel="stylesheet" type="text/css" href="/style.css"/>
	<link type="text/css" href="/css/themename/jquery-ui.min.css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script>
	  $( function() {
	    $( "#dialog" ).dialog();
	  } );
  </script>
</head>
<body>
	<div id="dialog" class="ui-state-default ui-corner-all">
		<p>Пациет <?php echo $ViewUpdate ?> записан в базу данный по id=<?php echo $this->Patient['AN_AMBKART'];?> </p>
	</div>
	<div>
		<form name="patientdata" method="get">
   			<p>Выберите дату: <input type="date" name="calendar">
   			<input class="ui-button ui-widget ui-corner-all" type="submit"  value="Поиск"></p>
		</form>
		</div>
</body>
</html>