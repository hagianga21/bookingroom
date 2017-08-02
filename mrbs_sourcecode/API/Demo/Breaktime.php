
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>MRBSHACK Break Time</title>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Amaranth:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript">
	function loadRoomList(){
		$.ajax({
			url : "GetRoomForBreaktime.php",
			type : "get",
			dateType:"text",
			data : {},
			success : function (result){
				$('#dv_room_select').html(result);
			}
		});
	}
</script>
</head>
<body onLoad="loadRoomList()">
    <div class="content">
		<h1>MRBSHACK Break Time</h1>
		<div class="main">
			<div id="clock" class="clock light">
				<div class="display">
					<div class="weekdays"></div>
					<div class="ampm"></div>
					<div class="alarm"></div>
					<div class="digits"></div>
				</div>
			</div> 
			<br><br><br><br>
			<div id="clockCountdown" class="clock light">
				<div class="display">
					<div class="digits"></div>
				</div>
			</div>
			<br><br>
			<center>
				<div class="country">
					<h3>Please choose your room!</h3>
					<div id="dv_room_select">
					</div>
					<!--<select required>
						<option value="">country</option>
						<option value="2">country1</option>
						<option value="3">country2</option>
						<option value="4">country3</option>
					</select>				-->
				</div>
			</center>
			<div class="button-holder">
				<a class="alarm-button"> Set Alarm</a>
			</div>

			<!-- The dialog is hidden with css -->
			<div class="overlay">

				<div id="alarm-dialog">

					<h2>Set Alarm After</h2>

					<label class="hours">
						Hours
						<input type="number" value="0" min="0" />
					</label>

					<label class="minutes">
						Minutes
						<input type="number" value="0" min="0" />
					</label>

					<label class="seconds">
						Seconds
						<input type="number" value="0" min="0" />
					</label>

					<div class="button-holder">
						<a id="alarm-set" class="button blue">Set</a>
						<a id="alarm-clear" class="button red">Clear</a>
					</div>

					<a class="close"></a>

				</div>

			</div>

			<div class="overlay">

				<div id="time-is-up">

					<h2>Time's up!</h2>

					<div class="button-holder">
						<a class="button blue">Close</a>
					</div>

				</div>

			</div>
			<audio id="alarm-ring" preload>
				<source src="audio/ticktac.mp3" type="audio/mpeg" />
				<source src="audio/ticktac.ogg" type="audio/ogg" />
			</audio>
			<!-- JavaScript Includes -->
			<script type="text/javascript" src="js/jquery.min.js"></script>
			<script type="text/javascript" src="js/moment.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>


	
		</div>
		<p class="footer">&copy; 2017 MRBSHACK Device, DEK TECHNOLOGYIES</p>
	</div>
</body>
</html>
