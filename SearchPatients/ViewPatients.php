<!DOCTYPE html>
<html>
<head>
	<title>Список за <?php echo ($_GET['calendar'])?></title>
	<link type="text/css" href="/css/themename/jquery-ui.min.css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<link  type="text/css" href="/style.css"/>
	<script>
		$( function() {
			$( ".modality").checkboxradio({
	    		icon: false
	    	
	    	});
	    	$(".modality").click(function(){
	    		if (this.checked) 
	    		{
	    			if (this.id=='MR') {$(".vis_MR").show("fast");}
	    			if (this.id=='CT') {$(".vis_CT").show("fast");}
	    			if (this.id=='MG') {$(".vis_MG").show("fast");}
	    		}
	    		else
	    		{
	    			if (this.id=='MR') {$(".vis_MR").hide("fast");}
	    			if (this.id=='CT') {$(".vis_CT").hide("fast");}
	    			if (this.id=='MG') {$(".vis_MG").hide("fast");}
	    		}
	    	});

	  	});
	  	$(function() {
	  		$( ".connect").checkboxradio({
	    		icon: false

	    	
	    	});
	    	$(".connect").click(function(){
	    		if (this.checked) 
	    		{
	    			if (this.id=='connected') {$(".connected").show("fast");}
	    			if (this.id=='disconnected') {$(".disconnected").show("fast");}
	    		}
	    		else
	    		{
	    			if (this.id=='connected') {$(".connected").hide("fast");}
	    			if (this.id=='disconnected') {$(".disconnected").hide("fast");}

	    		}
	    	});


	  	});
  	</script> 
  	<script>
		  $( function() {
		    $( ".dialog" ).dialog({
		      autoOpen: false,
		      width:600,
		    });
		 
		    $( ".opener" ).on( "click", function() { 
		    	var uid = $(this).attr('uid');
		    	$( ".dialog" ).html( '<iframe frameborder=0  src="http://orthanc/SearchPatients/index.php?uid='+uid+'"  width="100%" height="300">');
		        $( ".dialog" ).dialog( "open" );
		    });
		  } );
  	</script>

</head>
<body>
	<fieldset>
		<legend>Select modality</legend>
		<label for="MR">MR</label>
	    <input type="checkbox" name="MR" id="MR" class="modality" checked>
	    <label for="CT">CT</label>
	    <input type="checkbox" name="CT" id="CT" class="modality" checked>
	    <label for="MG">MG</label>
	    <input type="checkbox" name="MG" id="MG" class="modality" checked>   
	</fieldset>

	<fieldset>
		<legend>Select with/without card</legend>
		<label for="connected">Скрыть с карточкой</label>
	    <input type="checkbox" name="connected" id="connected" class="connect" checked>
	    <label for="disconnected">Скрыть без карточки</label>
	    <input type="checkbox" name="disconnected" id="disconnected" class="connect" checked>
	</fieldset>
	
	<style>
		.connected{
			background-color: rgba(128, 0, 0, 0.5);
		}
	</style>
	<div id="main">
		
		<div style="width: 50%">
			<?php  
				
				if ($this->PatientsList>0)
				{
				
					foreach ($this->PatientsList as $key=>$patient) 
					{
			?> 
			
				<div uid="<?php echo  $patient->PatientInfo['UID'];?>" class="ui-button ui-corner-all ui-widget opener vis_<?php echo $patient->PatientInfo['MODALITY'];?> <?php if($patient->PatientInfo['AN_AMBKART']) echo "connected"; else echo "disconnected";?>" style="width: 100%"> 
					<p style="font-size: 100%; text-align: left">
						<?php
							echo $patient->PatientInfo['NAME_ORTHANC'];
							//echo $patient->PatientInfo['UID'];
						?>
					</p>
					<p style="font-size: 70%; text-align: left" >
						<?php
							echo $patient->PatientInfo['BIRTH_DATE'];
						?>
					</p>				
				
					<p style="font-size: 80%; text-align: right;">
						<?php
							echo $patient->PatientInfo['MODALITY'];
						?>	
					</p>
					
			
				</div>
			

			<?php
					} 
				}else
					$error= "Дата не верная! Выберите другую дату";
					include 'ViewError.php';
		  
			?>


		</div>
		
	</div>	
			<div class="dialog" title="dialog"></div>
			


</body>
</html>
