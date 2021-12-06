<?php
ob_start("ob_gzhandler");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!-- META -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="content-language" content="sv">
	<meta name="description" content="" /> 
	<meta name="keywords" content="" /> 	
	<meta name="author" content="Linus Lilja" />
	<meta name="copyright" content="&copy; 2011 Linus Lilja">	
	
	<!-- TITLE -->
	<title><?echo $name ?> - <?echo $slogan ?></title>
	
	<!-- STYLESHEET -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/css.css?<?php $time = time(); echo sha1('a1'.$time); ?>">
	<link rel="stylesheet" type="text/css" media="screen" href="css/nivo-slider.css?<?php $time = time(); echo sha1('b2'.$time); ?>"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css?<?php $time = time(); echo sha1('c3'.$time); ?>"/>
	
	<!-- JAVASCRIPTS -->
	<script type="text/javascript" src="js/crir.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider();
		});
    </script>
	
	<!-- ICON -->
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"  />


</head>

<body>
	<div id="wrapper">
		<div id="main">
			<div id="header">
				<a href="#" onFocus="this.blur()" />
					<img src="images/header.png" border="0">
				</a>
			</div>
			
			<div id="meny">
				<a href="./?p=start">Hem</a> | <a href="./?p=produkter">Produkter</a> | <a href="./?p=">Teknik</a> | <a href="./?p=">Galleri</a> | <a href="./?p=media">Media</a> | <a href="./?p=team">Team</a> | <a href="./?p=butik">Butik</a> | <a href="./?p=kontakt">Kontakt</a>
			</div>
		
			<div id="cont">