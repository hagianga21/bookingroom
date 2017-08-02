#ifndef __HTML_CODE_H__
#define __HTML_CODE_H__

const char _mainPage[] PROGMEM = R"=====(
<html>

<head>
    <title>MRBSHACK - DEK Technologies</title>
    <style>
        html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
        article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
        ol,ul{list-style:none;margin:0px;padding:0px;}
        blockquote,q{quotes:none;}
        blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
        table{border-collapse:collapse;border-spacing:0;}
        /* start editing from here */
        a{text-decoration:none;}
        .txt-rt{text-align:right;}/* text align right */
        .txt-lt{text-align:left;}/* text align left */
        .txt-center{text-align:center;}/* text align center */
        .float-rt{float:right;}/* float right */
        .float-lt{float:left;}/* float left */
        .clear{clear:both;}/* clear float */
        .pos-relative{position:relative;}/* Position Relative */
        .pos-absolute{position:absolute;}/* Position Absolute */
        .vertical-base{	vertical-align:baseline;}/* vertical align baseline */
        .vertical-top{	vertical-align:top;}/* vertical align top */
        nav.vertical ul li{	display:block;}/* vertical menu */
        nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
        img{max-width:100%;}
        /*end reset*/
        /*--start-body--*/
        body{
        position:relative;
        font-family: 'Lato', sans-serif;

        }
        h1 {
        text-align: center;
            color: #fff;
            font-size: 3em;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-family: 'Amaranth', sans-serif;
        }
        .w3-signup-head-top h3 {
            color: #ff0000;
            font-size: 2em;
            margin-top: 15px;
            margin-bottom: 28px;
            font-family: 'Amaranth', sans-serif;
        }
        .w3-agile-signup-top {
            padding: 2em 0;
            background:rgba(0, 0, 0, 0.64);
        }
        .w3-signup-head2-top h3 {
            color: #fff;
            background: #3d50e2;
            width: 25%;
            margin-bottom: 28px;
            border: 2px solid #3d50e2;
            border-radius: 12px;
            font-family: 'Amaranth', sans-serif;
        }
        .main {
            margin: 0 auto;
            text-align: center;
            width: 35%;
        }
        /*-- /login --*/
        .login-top.left{
            padding:2em;
            margin: 1em 0;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .login-top input[type="text"], .login-top input[type="password"] {
            outline: none;
            font-size:0.9em;
            color: #000000;
            padding: 12px 12px 12px 40px;
            margin: 0;
            width: 89%;
            border:1px solid #ddd;
            border-bottom: 1px solid #ddd;
            -webkit-appearance: none;
            margin-bottom: 28px;
            font-family: 'Rationale', sans-serif;
        }
        .login-top span {
            font-weight: normal;
            color: #000000;
            margin-left: 3px;
        }
        .login-top.left input[type="submit"] {
            font-size: 1em;
            color: #fff;
            background:#2dde98;
            outline: none;
            border: none;
            cursor: pointer;
            padding: 15px 10px;
            -webkit-appearance: none;
            width: 100%;
            font-weight: 400;
            transition: .5s all;
            -webkit-transition: .5s all;
            -moz-transition: .5s all;
            -o-transition: .5s all;
            -ms-transition: .5s all;
            text-transform: uppercase;
            margin-top: 1.3em;
            font-family: 'Rationale', sans-serif;
        }
        .login-top.left input[type="submit"]:hover{
            background:#fd5c63;
        }

        .login-top input[type="text"]:focus, .login-top input[type="password"]:focus{
            
        }
        .login-top input.name {
            /*background:#fff url("192.168.122.26/esp8266_sourcecode/MRBS_ESP8266/images/1.png") no-repeat 2% 51%;*/
        }
        .login-top input.email {
           /*background:#fff url("192.168.122.26/esp8266_sourcecode/MRBS_ESP8266/images/3.png") no-repeat 2% 51%;*/
        }
        .login-top input.password {
            /*background:#fff url("192.168.122.26/esp8266_sourcecode/MRBS_ESP8266/images/2.png") no-repeat 2% 51%;*/
        }
        .login-top input[type="text"]:hover, .login-top input[type="password"]:hover{
            border-bottom-color:rgba(132, 141, 215, 0.52);
        }
        .login-top .button-text-save{
            float: right;
            width: 49%;
        }
        .login-top .button-text-reset{
            float: left;
            width: 49%;
        }
        .copy-right {
            text-align: center;
            margin: 1em 0 0 0;
        }
        .copy-right p {
            color: #fff;
            font-size: 1em;
            font-weight: 400;
            font-family: 'Amaranth', sans-serif;
            letter-spacing: 2px;
            margin-top: 30px;
        }
		@media (max-width:1920px){
			.w3-agile-signup-top {
				padding: 7em 0;
			}

		}
		@media (max-width:1600px){
			.w3-agile-signup-top {
				padding: 2em 0;
			}

		}
		@media (max-width:1440px){
			.main {
				text-align: center;
				width: 35%;
			}
		}
		@media (max-width:1366px){
			.main {
				text-align: center;
				width: 35%;
			}
		}
		@media (max-width:1280px){
			.main {
				text-align: center;
				width: 35%;
			}
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 86%;
			}

		@media (max-width:1280px){
			.main {
				text-align: center;
				width: 45%;
			}
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 86%;
			}
		}
		@media (max-width:1028px){
			
			.main {
				text-align: center;
				width:45%;
			}
		}
		@media (max-width:991px){
			.main {
				text-align: center;
				width:45%;
			}
		}
		@media (max-width:800px){
			.login-top.left {
				float: left;
				width: 88%;
				padding: 2em;
			}
			.main {
				text-align: center;
				width:45%;
			}
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 83%;
			}
			.main {
				margin-left: 12em;
			}
		}
		@media (max-width:768px){
			.main {
				text-align: center;
				width: 45%;
			}
			.login-top.left {
				width: 90%;
			}
		}
		@media (max-width:736px){
			.main {
				margin-left: 11em;
			}
		}
		@media (max-width:667px){
			.login-top.left {
				width: 100%;
			}
			.main {
				margin-left: 9em;
			}
		}
		@media (max-width:640px){

		}
		@media (max-width:600px){
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 81%;
			}
			.main {
				margin-left: 8em;
			}
		}
		@media (max-width:568px){
			.copy-right p {
				font-size: 0.85em;
				line-height: 1.8em;
			}
			.login-top.left {
				width: 100%;
			}
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 79%;
			}
			.main {
				margin-left: 7.5em;
			}
		}
		@media (max-width:480px){
			.copy-right p {
				font-size: 0.85em;
				line-height: 1.8em;
				padding: 0 2px;
			}
			.main {
				text-align: center;
				width: 64%;
			}
			h1 {
				font-size: 2.5em;
			}
			.main {
				text-align: center;
				width: 64%;
				margin-left: 3em;
			}
		}
		@media (max-width:414px){
			.copy-right {
				margin: 1em 0 1em 0;
			}

			h1 {
				font-size: 2.2em;
			}
			.main {
				text-align: center;
				width: 68%;
				margin-left: 2em;
			}
		}
		@media (max-width:384px){
			.login-top.left {
				width: 100%;
			}
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 81%;
				margin-bottom: 10px;
			}
			.main {
				margin-left: 2em;
			}
			h1 {
				font-size: 2em;
			}
			.main {
				margin-left: 1.5em;
			}
		}
		@media (max-width:375px){
			.login-top.left {
				width: 100%;
			}
		}
		@media (max-width:320px){
			.login-top.left {
				width:100%;
			}
			.main {
				width:80%;
			}
			h1 {
				font-size: 1.7em;
			}
			.login-top input[type="text"], .login-top input[type="password"] {
				width: 73%;
			}
			.main {
				margin-left: 0.8em;
			}
			.login-top.left {
				padding: 1em;
			}
			.w3-signup-head-top h3 {
				font-size: 1.5em;
			}
			.login-top.left input[type="submit"] {
				width: 81%;
			}
		}
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- //end-smoth-scrolling -->
    <link href="//fonts.googleapis.com/css?family=Rationale" rel="stylesheet">
	  <link href="//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">
	  <link href="//fonts.googleapis.com/css?family=Amaranth:400,400italic,700,700italic" rel="stylesheet" type="text/css">
	<script type="text/javascript">
					var notifyString1 = 'Too much data in ';
					var notifyString2 = ' text box! Please remove ';
					var notifyString3 = 'Too few data in ';
					var notifyString4 = ' text box! Please add ';

					function checkValidDataSubmit() 
					{
						//var flag;
						if (!checkLengthAndAlert('apSSID','AP SSID', 32))
							return false;
						if (!checkLengthAndAlert('apPassword','AP Password', 64, 8))
							return false;
						if (!checkLengthAndAlert('staSSID','STA SSID', 32))
							return false;
						if (!checkLengthAndAlert('staPassword','STA Password', 64, 8))
							return false;
						if (!checkLengthAndAlert('serverHost','Server Host', 15))
							return false;
						if (!checkLengthAndAlert('serverPort','Server Port', 5))
							return false;
						if (!checkLengthAndAlert('pathName','Path Name', 60))
							return false;
						if (!checkLengthAndAlert('idRoom','ID Room', 2))
							return false;
						if (!checkLengthAndAlert('apiKey','API Key', 25))
							return false;
						if (checkValidNumber('serverPort') && checkValidNumber('idRoom'))
							return true;
						return false;
					}

					function checkLengthAndAlert(idTextBoxCheck, textboxToNotify, maxChars, minChars = 0)
					{
						var textLength = document.getElementById(idTextBoxCheck).value.length;

						if (textLength > maxChars) {
							alert(notifyString1 + textboxToNotify + notifyString2 +
								  (textLength - maxChars) + ' characters');
							return false;
						}
						else if (textLength < minChars && textLength != 0) {
							alert(notifyString3 + textboxToNotify + notifyString4 +
								  (minChars - textLength) + ' characters');
							return false;
						}
						return true;
					}

					function checkValidNumber(idTextBoxCheck)
					{
						var elementValue = document.getElementById(idTextBoxCheck).value;

						if (elementValue.length == 0)
							return true;
						if (parseFloat(Number(elementValue)) - parseInt(elementValue,10) == 0)
							return true;
						else
						{	
							alert('Server Port and ID Room must be an integer');
							return false;
						}
					}

					function updateCheck(idTextBoxCheck, idNotify, maxChars, minChars = 0) 
					{
						var element = document.getElementById(idNotify);
						var textLength = document.getElementById(idTextBoxCheck).value.length;

						if (textLength > maxChars || (textLength < minChars && textLength != 0)) {
							element.style.fontWeight = 'bold';
							element.style.color = '#ff0000';
						}
						else 
						{
							element.style.fontWeight = 'normal';
							element.style.color = '#000000';
						}
					}

					function nullPasswordHandle(idCheckBox, idTextBox)
					{
						var check = document.getElementById(idCheckBox).checked;
						var element = document.getElementById(idTextBox);
						var namePasswordTextBox;

						if(idCheckBox == 'apPasswordNull')
							namePasswordTextBox = 'AP Password - Default: doo9eequefien4Pho';
						else
							namePasswordTextBox = 'STA Password - Default: doo9eequefien4Pho';

						if(check)
						{
							element.disabled = true;
							element.value = null;
							element.placeholder = "Password -> NULL";
							updateCheck('apPassword','apPasswordNotify',64,8);
							updateCheck('staPassword','staPasswordNotify',64,8);
						}
						else
						{
							element.disabled = false;
							element.placeholder = namePasswordTextBox;
						}
					}
				</script>
</head>

<body bgcolor="#000000">
	<div class="w3-agile-signup-top">
		<h1>
			<font face="Amaranth">MRBSHACK Config Info</font>
		</h1>
		<div class="main">
			<div class="login-top left">
				<form action="thanks" method="post" name="configForm" onsubmit="return checkValidDataSubmit()">
					<div class="w3-signup-head-top">
						<h3>Network Configuration</h3>
					</div>
					<div class="w3-signup-head2-top">
						<h3>Access Point</h3>
					</div>
					<input type="text" name="apSSID" id="apSSID" class="name" placeholder="AP SSID - Default: ESP8266" 
						onkeyup="updateCheck('apSSID','apSSIDNotify',32);">
					<span id="apSSIDNotify">x</span>
					<input type="password" name="apPassword" id="apPassword" class="password" placeholder="AP Password - Default: doo9eequefien4Pho"
						onkeyup="updateCheck('apPassword','apPasswordNotify',64,8);">
					<span id="apPasswordNotify">x</span>
					<br>
					<input type="checkbox" name="apPasswordNull" id="apPasswordNull" value="null_password" 
						title="Check if you don't use password for Access Point" onclick="nullPasswordHandle('apPasswordNull','apPassword')">
					<span style="color: white"> Password is null?</span><br><br>

					<div class="w3-signup-head2-top">
						<h3>Station</h3>
					</div>
					<input type="text" name="staSSID" id="staSSID" class="name" placeholder="STA SSID - Default: dekvnintern"
						onkeyup="updateCheck('staSSID','staSSIDNotify',32);">
					<span id="staSSIDNotify">x</span>	
					<input type="password" name="staPassword" id="staPassword" class="password" placeholder="STA Password - Default: doo9eequefien4Pho"
						onkeyup="updateCheck('staPassword','staPasswordNotify',64,8);">
					<span id="staPasswordNotify">x</span>
					<br>
					<input type="checkbox" name="staPasswordNull" id="staPasswordNull" value="null_password" 
						title="Check if you don't use password for Station" onclick="nullPasswordHandle('staPasswordNull','staPassword')">
					<span style="color: white"> Password is null?</span><br><br>
					<div class="w3-signup-head-top">
						<h3>MRBS Configuration</h3>
					</div>
					<input type="text" name="serverHost" id="serverHost" class="email" placeholder="HOST - Default: 192.168.122.26"
						onkeyup="updateCheck('serverHost','serverHostNotify',15);">
					<span id="serverHostNotify">x</span>
					<input type="text" name="serverPort" id="serverPort" class="email" placeholder="PORT - Default: 80"
						onkeyup="updateCheck('serverPort','serverPortNotify',5);">
					<span id="serverPortNotify">x</span>
					<input type="text" name="pathName" id="pathName" class="email" placeholder="PATH - Default: /mrbs_sourcecode/API/MainAPI.php"
						onkeyup="updateCheck('pathName','pathNameNotify',60);">
					<span id="pathNameNotify">x</span>
					<input type="text" name="idRoom" id="idRoom" class="email" placeholder="ID ROOM - Default: 2"
						onkeyup="updateCheck('idRoom','idRoomNotify',2);">
					<span id="idRoomNotify">x</span>
					<input type="text" name="apiKey" id="apiKey" class="email" placeholder="API KEY - Default: T7ya9Ud09zLuC3ieFp5GD"
						onkeyup="updateCheck('apiKey','apiKeyNotify',25);">
					<span id="apiKeyNotify">x</span>
					<div class="button-text-save">
						<input type="submit" name="save_button" value="SAVE">
					</div>
					<div class="button-text-reset">
						<input type="submit" name="reset_button" value="RESET">
					</div>
					<div class="clear"></div>
				</form>
			</div>
		</div>
		<div class="clear"></div>
		<div class="copy-right w3l-agile">
			<p> © 2017 MRBSHACK Device, DEK TECHNOLOGIES</p>
		</div>
		<div class="clear"></div>
	</div>
</body>

</html>
)=====";

const char _thanksPage[] PROGMEM = R"=====(
<html>

<head>
	<title></title>
</head>

<body>
	<div class="title" id="header" style="background:#aee4ef;border:1px solid #ccc;padding:5px 10px;">
		<h1 style="text-align: center;">
            <span style="color:#ff1414;"><span style="font-family: 'Amaranth', sans-serif;">
                <span style="font-size:28px;">THANK YOU FOR USING MRBS HACK</span></span>
                <br><br>
                <span style="font-size:20px;">Your configure has been saved. Device will reset immediately</span></span>
			</span>
		</h1>
	</div>
	<p>&nbsp;</p>
</body>

</html>
)=====";

#endif
