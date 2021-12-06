<?php
	// Inställningar
	$name = "One Beer Boards";
	$slogan = "No Champagne";
	$pwd = "obb";

	if (isset($_POST["pwd"])) {
	    if ($_POST["pwd"] === $pwd) {
			$_SESSION["inloggning"] = true;
			header("Location: admin.php");
	    	exit;
	    } else {
			header("Location: admin.php?badlogin=");
			exit;
		} 
	}

	function safemail($addr) {
		$ret = '';
		for($i=0;$i<strlen($addr);$i++) {
			$ret .= '&#'.ord($addr[$i]).';';
		}
		return $ret;
	}
	$mail = safemail("onebeerboards@gmail.com");
	
	$undersidor = array(
	'start' => 'start.php',
	'produkter' => 'products.php',
	'media' => 'media.php',
	'team' => 'team.php',
	'butik' => 'butik.php',
	'kontakt' => 'kontakt.php',
	'policy' => 'policy.php',
	'info' => 'info.php',
	'varukorg' => 'varukorg.php',
	'admin' => 'admin.php',
	// Produkt
	'malt' => 'products/malt.php'
	);
?>