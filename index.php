<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Geolocation API Demo</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>

<script type="text/javascript" charset="utf-8">

function successHandler(location) {
    var message = document.getElementById("message"), html = [];
    html.push("<img width='256' height='256' src='http://maps.google.com/maps/api/staticmap?center=", location.coords.latitude, ",", location.coords.longitude, "&markers=size:small|color:blue|", location.coords.latitude, ",", location.coords.longitude, "&zoom=14&size=256x256&sensor=false' />");
    // html.push("<p>Latitude: ", location.coords.latitude, "</p>");
    // html.push("<p>Accuracy: ", location.coords.accuracy, " meters</p>");
    message.innerHTML = html.join("");
    document.getElementById('location').value = location.coords.longitude + '/' + location.coords.latitude;
    document.getElementById('accuracy').value = location.coords.accuracy;
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}

navigator.geolocation.getCurrentPosition(successHandler, errorHandler);

$(document).ready(function() {
	var deviceAgent = navigator.userAgent.toLowerCase();
	$('#device-details').val(deviceAgent);
});

</script>

<style>
	input[type='radio'] {
		display:none;
	}
	label {
		float:left;
	}
	#wrapper {
		width:350px;
	}
	
	label.label-yes {
		background-image:url('./yes-no.png');
		width:100px;
		height:50px;
		background-repeat:no-repeat;
		display:block;
		text-indent:-9999px;
		background-position: 0 -50px;
	}
	label.label-yes.checked {
		background-position:0 0;		
	}
	label.label-no.checked {
		background-position:-100px 0;		
	}	
	label.label-no {
		background-image:url('./yes-no.png');
		width:100px;
		height:50px;
		background-repeat:no-repeat;
		display:block;
		text-indent:-9999px;
		background-position: -100px -50px;
	}
	
	label.label-indoors {
		background-image:url('./indoors-outdoors.png');
		width:100px;
		height:91px;
		background-repeat:no-repeat;
		display:block;
		text-indent:-9999px;
		background-position: 0 -91px;
		float:left;
		clear:left;
	}
	label.label-indoors.checked {
		background-position:0 0;		
	}
	label.label-outdoors.checked {
		background-position:-100px 0;		
	}	
	label.label-outdoors {
		background-image:url('./indoors-outdoors.png');
		width:100px;
		height:91px;
		background-repeat:no-repeat;
		display:block;
		text-indent:-9999px;
		background-position: -100px -91px;
	}
	textarea {
		display:none;
	}
	.thankyounote {
		float:left;
		clear:left;
		margin-top:20px;
		margin-bottom:20px;
		padding:4px 20px;
		border:1px solid #00658f;
		background:#71bfe0;
		position:relative;
		animation:mymove 3s ease-out forwards;
		animation-iteration-count:1;
		animation-fill-mode: forwards;		
		/* Safari and Chrome */
		-webkit-animation:mymove 3s;
		-webkit-animation-iteration-count:1;
		-webkit-animation-fill-mode: forwards;
	}
	
	@keyframes mymove
	{ 
	from {top:30px;opacity:0;}
	to {top:0px;opacity:1;}
	}

	@-webkit-keyframes mymove /* Safari and Chrome */
	{
	from {top:30px;opacity:0;}
	to {top:0px;opacity:1;}
	}
	
	.hidden {
		display:none;
	}
	
</style>

 </head>
<body>
<div id="wrapper">
<div id="message">Loading location...</div>
<div class="thankyounote hidden">
	<p>Thank you for your help testing this script! No need to do anything else, your device model and OS version have been logged to our database.</p>
</div>
<form id="form2" action="submit.php" method="post">
	<h3>Does the map show up with your approximate location?</h3>
	<input type="radio" name="did-it-work" value="yes" id="yes" class="checkbox" /><label for="yes" class="label-yes">YES</label>
	<input type="radio" name="did-it-work" value="no" id="no" class="checkbox" /><label for="no" class="label-no">NO</label>
	<br /><br /><br />
	<h3>Are you indoors or outdoors?</h3>	
	<input type="radio" name="indoors-outdoors" value="indoors" id="indoors" class="checkbox" /><label for="indoors" class="label-indoors">Inside</label>
	<input type="radio" name="indoors-outdoors" value="outdoors" id="outdoors" class="checkbox" /><label for="outdoors" class="label-outdoors">Outside</label>
	<input type="text" name="location" id="location" value="" hidden />
	<input type="text" name="accuracy" id="accuracy" value="" hidden />	
	<textarea id="device-details" name="device-details" hidden>
	</textarea>	
</form>


</div><!--#end Wrapper-->
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){

			$("input[name='did-it-work']").change(function(){
				if($(this).is(":checked")){
					$(this).find(".checked").removeClass('checked');	
					$(this).next("label").addClass('checked');
					var radioName = $(this).attr("name"); //Get radio name
				   	$(":radio[name='"+radioName+"']").attr("hidden", true);
				}
				else{
					// $(this).next("label").removeClass('checked');
				}
			});
			
			$("input[name='indoors-outdoors']").change(function(){
				if($(this).is(":checked")){
					$(this).find(".checked").removeClass('checked');	
					$(this).next("label").addClass('checked');
					var radioName = $(this).attr("name"); //Get radio name
				   	$(":radio[name='"+radioName+"']").attr("hidden", true);
				}
				else{
					// $(this).next("label").removeClass('checked');
				}
			});
			
	});




 	
		$("input[name='indoors-outdoors']").change(function() {
   		   if($("input[name='did-it-work']").is(':checked')) {
			   submitData();
			} else {
				//
			}					
		});
		
		$("input[name='did-it-work']").change(function() {
   		   if($("input[name='indoors-outdoors']").is(':checked')) {
			   submitData();
			} else {
		// 		
			}				
		});
		
		function submitData() {
			 var formData = jQuery("#form2").serializeArray();

				jQuery.ajax({
				      url: "./save.php",
				      type: "POST",
				      data: formData,
				      success: function(data) {
			            // alert(data);		
			          // if(data["success"]) {
						$('.thankyounote').removeClass('hidden');
			          // }
				      },
					 error: function(data) {
						// alert('couldn\'t submit results');
						// $('.thankyounote').removeClass('hidden');
					 }
				});
		}

</script>

</body>
</html>