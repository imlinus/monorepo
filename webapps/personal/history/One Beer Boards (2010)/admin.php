<?php
session_start();

	$pwd = "obb";
	
	if (isset($_POST["pwd"])) {
	    if ($_POST["pwd"] === $pwd) {
			$_SESSION["inloggning"] = true;
			header("Location: ./?p=admin");
	    	exit;
	    }
	    else {
			header("Location: ./?p=admin&badlogin=");
			exit;
		} 
	}
	
	if (!isset($_SESSION['inloggning'])) {
?>

<div class="contn">
	<h3>Administrat�r</h3>
	<p>H�r loggar administrat�rer f�r One Beer Boards in f�r att l�gga till varor & dyligt.</p><br />
	<form action="admin.php" method="post" id="forms" />
		<div>
			<input name="pwd" type="password" style="width: 120px;" />
			<input name="send" type="submit" value="Logga In" />
		</div>
	</form>
	
	<?php
	if (isset($_GET['badlogin'])) {
		echo "<br />Fel l�senord!<br />\n";
	}
	?>
</div>

<?php
} 

elseif (isset($_SESSION['inloggning'])) {
	echo '<div class="contn">';
	echo '<h3>Administrat�r</h3>
		<p><a href="./?p=admin&produkt">L�gg till produkt</a> | <a href="./?p=admin&info">L�gg till infosida</a> | <a href="./?p=admin&slide">Uppdatera Slideshow</a> | <a href="logout.php">Logga Ut</a></p><br />';
	
	if (isset($_GET['produkt'])) {
		echo '<p><b>L�gg till produkt</b></p><br />
			<form action="" method="post" id="forms" />
				<div>
					<label>Produktnamn:</label><br />
					<input name="name" type="text" style="width: 220px;" /><br /><br />
					
					<label>Information:</label><br />
					<textarea name="info" style="width: 420px; height: 200px;" /></textarea><br /><br />
					
					<label>Pris (Fr�n):</label><br />
					<input name="pris" type="text" style="width: 220px;" /><br /><br />
					
					<label>L�nk till bild (Liten: 159x260px):</label><br />
					<input name="slide" type="text" style="width: 220px;" /><br /><br />
					
					<label>L�nk till bild (Stor: 360x630px):</label><br />
					<input name="slide" type="text" style="width: 220px;" /><br /><br />
					
					<input name="send" type="submit" value="L�gg Till" />
				</div>
			</form>';
	}
	
	if (isset($_GET['info'])){
		echo '<p><b>L�gg till Infosida</b></p><br />';
	}
	
	if (isset($_GET['slide'])){
		echo '<p><b>Uppdatera Slideshow</b></p><br />
			<form action="" method="post" id="forms" />
				<div>
					<label>L�nk till bild (940x140px):</label><br />
					<input name="slide" type="text" style="width: 220px;" />
					<input name="send" type="submit" value="Uppdatera" />
				</div>
			</form>';
	}
	
	echo '</div>';
}
?>