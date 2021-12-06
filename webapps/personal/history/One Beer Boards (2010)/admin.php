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
	<h3>Administratör</h3>
	<p>Här loggar administratörer för One Beer Boards in för att lägga till varor & dyligt.</p><br />
	<form action="admin.php" method="post" id="forms" />
		<div>
			<input name="pwd" type="password" style="width: 120px;" />
			<input name="send" type="submit" value="Logga In" />
		</div>
	</form>
	
	<?php
	if (isset($_GET['badlogin'])) {
		echo "<br />Fel lösenord!<br />\n";
	}
	?>
</div>

<?php
} 

elseif (isset($_SESSION['inloggning'])) {
	echo '<div class="contn">';
	echo '<h3>Administratör</h3>
		<p><a href="./?p=admin&produkt">Lägg till produkt</a> | <a href="./?p=admin&info">Lägg till infosida</a> | <a href="./?p=admin&slide">Uppdatera Slideshow</a> | <a href="logout.php">Logga Ut</a></p><br />';
	
	if (isset($_GET['produkt'])) {
		echo '<p><b>Lägg till produkt</b></p><br />
			<form action="" method="post" id="forms" />
				<div>
					<label>Produktnamn:</label><br />
					<input name="name" type="text" style="width: 220px;" /><br /><br />
					
					<label>Information:</label><br />
					<textarea name="info" style="width: 420px; height: 200px;" /></textarea><br /><br />
					
					<label>Pris (Från):</label><br />
					<input name="pris" type="text" style="width: 220px;" /><br /><br />
					
					<label>Länk till bild (Liten: 159x260px):</label><br />
					<input name="slide" type="text" style="width: 220px;" /><br /><br />
					
					<label>Länk till bild (Stor: 360x630px):</label><br />
					<input name="slide" type="text" style="width: 220px;" /><br /><br />
					
					<input name="send" type="submit" value="Lägg Till" />
				</div>
			</form>';
	}
	
	if (isset($_GET['info'])){
		echo '<p><b>Lägg till Infosida</b></p><br />';
	}
	
	if (isset($_GET['slide'])){
		echo '<p><b>Uppdatera Slideshow</b></p><br />
			<form action="" method="post" id="forms" />
				<div>
					<label>Länk till bild (940x140px):</label><br />
					<input name="slide" type="text" style="width: 220px;" />
					<input name="send" type="submit" value="Uppdatera" />
				</div>
			</form>';
	}
	
	echo '</div>';
}
?>