<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(isset($_SESSION["pass"])) {
		header('Location: data/');
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="icon" type="image/png" href="assets/empresa/logo/logo.png" />
<title>SEG-ACCESO</title>
<style type="text/css">
body {
	background: #161616 url(pattern_40.gif) top left repeat;
	margin: 0;
	padding: 0;
	font: 12px normal Verdana, Arial, Helvetica, sans-serif;
	height: 100%;
}

* {margin: 0; padding: 0; outline: none;}

img {border: none;}

a { 
	text-decoration:none; 
	color:#00c6ff;
}

h1 {
	font: 4em normal Arial, Helvetica, sans-serif;
	padding: 13px;	margin: 0;
	text-align:center;
	color:#bbb;
}

h1 small{
	font: 0.2em normal  Arial, Helvetica, sans-serif;
	text-transform:uppercase; letter-spacing: 0.2em; line-height: 5em;
	display: block;
}

.container {width: 200px; margin: 0 auto; overflow: hidden; text-align: center;}
.content {width:200px; margin:0 auto; padding-top:50px; }
#resultado{
	width: 100%;
	font: normal Arial, Helvetica, sans-serif;
	font-size: 12px;
	padding: 8px;	margin: 0;
	text-align:center;
	color:#bbb;
}
.contentBar {width:90px; margin:0 auto; padding-top:50px; padding-bottom:50px;}
/* Second Loadin Circle */

.circle {
	background-color: rgba(0,0,0,0);
	border:5px solid rgba(0,183,229,0.9);
	opacity:.9;
	border-right:5px solid rgba(0,0,0,0);
	border-left:5px solid rgba(0,0,0,0);
	border-radius:50px;
	box-shadow: 0 0 35px #2187e7;
	width:50px;
	height:50px;
	margin:0 auto;
	-moz-animation:spinPulse 1s infinite ease-in-out;
	-webkit-animation:spinPulse 1s infinite linear;
}
.circle1 {
	background-color: rgba(0,0,0,0);
	border:5px solid rgba(0,183,229,0.9);
	opacity:.9;
	border-left:5px solid rgba(0,0,0,0);
	border-right:5px solid rgba(0,0,0,0);
	border-radius:50px;
	box-shadow: 0 0 15px #2187e7; 
	width:30px;
	height:30px;
	margin:0 auto;
	position:relative;
	top:-50px;
	-moz-animation:spinoffPulse 1s infinite linear;
	-webkit-animation:spinoffPulse 1s infinite linear;
}

@-moz-keyframes spinPulse {
	0% { -moz-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7;}
	50% { -moz-transform:rotate(145deg); opacity:1; }
	100% { -moz-transform:rotate(-320deg); opacity:0; }
}
@-moz-keyframes spinoffPulse {
	0% { -moz-transform:rotate(0deg); }
	100% { -moz-transform:rotate(360deg);  }
}
@-webkit-keyframes spinPulse {
	0% { -webkit-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7; }
	50% { -webkit-transform:rotate(145deg); opacity:1;}
	100% { -webkit-transform:rotate(-320deg); opacity:0; }
}
@-webkit-keyframes spinoffPulse {
	0% { -webkit-transform:rotate(0deg); }
	100% { -webkit-transform:rotate(360deg); }
}

/* LITTLE BAR */

.barlittle {
	background-color:#2187e7;  
	background-image: -moz-linear-gradient(45deg, #2187e7 25%, #a0eaff); 
	background-image: -webkit-linear-gradient(45deg, #2187e7 25%, #a0eaff);
	border-left:1px solid #111; border-top:1px solid #111; border-right:1px solid #333; border-bottom:1px solid #333; 
	width:10px;
	height:10px;
	float:left;
	margin-left:5px;
    opacity:0.1;
	-moz-transform:scale(0.7);
	-webkit-transform:scale(0.7);
	-moz-animation:move 1s infinite linear;
	-webkit-animation:move 1s infinite linear;
}
#block_1{
 	-moz-animation-delay: .4s;
	-webkit-animation-delay: .4s;
 }
#block_2{
 	-moz-animation-delay: .3s;
	-webkit-animation-delay: .3s;
}
#block_3{
 	-moz-animation-delay: .2s;
	-webkit-animation-delay: .2s;
}
#block_4{
 	-moz-animation-delay: .3s;
	-webkit-animation-delay: .3s;
}
#block_5{
 	-moz-animation-delay: .4s;
	-webkit-animation-delay: .4s;
}
@-moz-keyframes move{
	0%{-moz-transform: scale(1.2);opacity:1;}
	100%{-moz-transform: scale(0.7);opacity:0.1;}
}
@-webkit-keyframes move{
	0%{-webkit-transform: scale(1.2);opacity:1;}
	100%{-webkit-transform: scale(0.7);opacity:0.1;}
}

/* Trigger button for javascript */

.trigger, .triggerFull, .triggerBar {
	background: #000000;
	background: -moz-linear-gradient(top, #161616 0%, #000000 100%);
	background: -webkit-linear-gradient(top, #161616 0%,#000000 100%);
	border-left:1px solid #111; border-top:1px solid #111; border-right:1px solid #333; border-bottom:1px solid #333; 
	font-family: Verdana, Geneva, sans-serif;
	font-size: 0.8em;
	text-decoration: none;
	text-transform: lowercase;
	text-align: center;
	color: #fff;
	padding: 10px;
	border-radius: 3px;
	display: block;
	margin: 0 auto;
	width: 140px;
}
		
.trigger:hover, .triggerFull:hover, .triggerBar:hover {
	background: -moz-linear-gradient(top, #202020 0%, #161616 100%);
	background: -webkit-linear-gradient(top, #202020 0%, #161616 100%);
}

</style>
<script src="assets/js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script>		
$(document).ready(function() {
	$('.ball, .ball1').removeClass('stop');	    
		$('.trigger').click(function() {
				$('.ball, .ball1').toggleClass('stop');
		});
});

$(document).ready(function() {
	$('.circle, .circle1').removeClass('stop');	    
		$('.triggerFull').click(function() {
				$('.circle, .circle1').toggleClass('stop');
		});
});

$(document).ready(function() {
	$('.barlittle').removeClass('stop');	    
		$('.triggerBar').click(function() {
				$('.barlittle').toggleClass('stop');
		});
});

</script>
</head>
<body>
<h1>Accesando Aplicación<small> | <a href="">inicia</a></small></h1>
<!-- LOOP LOADER -->

<div class="container">
	<div class="content">
    <div class="circle"></div>
    <div class="circle1"></div>
    </div>
    <div id="resultado">Iniciando...</div>
</div>

<!-- END LOOP LOADER -->
</body>
</html>
<script type="text/javascript">
	function redireccionar() {
	    setTimeout("location.href='inicio'", 1000);
	  }               
    redireccionar();
</script>