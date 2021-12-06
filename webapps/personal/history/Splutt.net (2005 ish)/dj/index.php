<html>
<head>

<title>DJ</title>
<link rel="stylesheet" href="css.css" type="text/css">

</head>
<body bgcolor="#501000">

<table border="0" width="100%" height="100%">

<tr>
<td align="center" valign="center">

		<table border="0" style="border:solid 3px #000000;" background="bg.PNG" width="906" height="720">
		<tr>
		<td height="220" colspan="2">
		</td>
		</tr>
		<tr>
		<td valign="top" width="250">
			<div id="rutan">
				<b>Välkommen till min nya hemsida</b> <br><br> Här kommer du att kunna lyssna på mina låtar nere i MP3 - Spelaren.
			</div>
		</td>

		<td valign="top" width="450"></td>
		<td valign="top" align="left">

		<div id="rutan">
			<img src="spacer.gif" height="396" width="100" border="0"><br>
			<img src="spacer.gif" height="20" width="14" border="0" align="left">

		<marquee width="100">

			<?php

			if (isset($_GET['id'])) {
				$_GET['id'] = $id ;

			 	if ($id == 0) {
					echo "Lady Gaga - Pokerface";
					echo '<embed src="http://ung.burtrask.com/users/mp3/anton_och_affe-vaerdeloes_%28fylletrack%29-frizon.info.mp3" width="0" height="0" autostart="true" hidden="true">';
				} 

			    elseif ($id == 2) {
					echo "Laggg";
					echo '<embed src="http://ung.burtrask.com/users/mp3/anton_och_affe-vaerdeloes_%28fylletrack%29-frizon.info.mp3" width="0" height="0" autostart="true" hidden="true">';
				} 

			    elseif ($id == 3) {
					echo "Ladsss";
					echo '<embed src="http://ung.burtrask.com/users/mp3/anton_och_affe-vaerdeloes_%28fylletrack%29-frizon.info.mp3" width="0" height="0" autostart="true" hidden="true">';
				} 
				else {
			        echo "Det finns inga fler låtar.";
			    }
			}

			/*
			else {
			    $id = 1;
					echo "Laddddd";
					echo '<embed src="http://c.wrzuta.pl/wa6187/6a7d594d000fd3ae4ba8e47a/0/lady%20gaga%20-%20poker%20face.mp3" width="0" height="0" autostart="true" hidden="true">';
				}
			}
			$_GET['id'] = $id ;
			*/
			
			?>

		</marquee>

		</div>
		<br>
			<img src="spacer.gif" width="5" height="13"><br>
			<img src="spacer.gif" width="10" height="1">

			<a href="index.php?id=<? --$id; echo $id; ?>"><img src="bak.gif" border="0"></a>

			<img src="spacer.gif" width="2" height="1">

			<a href="index.php?id=<? ++$id; ++$id; echo $id; ?>"><img src="fram.gif" border="0"></a>
		</td>
		</tr>
		</table>

</td>
</tr>
</table>
<body>
</html>