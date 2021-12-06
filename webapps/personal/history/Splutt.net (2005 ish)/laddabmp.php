  <?
 //Väljer vart bilderna ska hamna
 $mapp = 'images/';
 
 //Lägger in orginalnamnet i en variabel
 $filnamn = $_FILES["fil"]["name"];
 
 //Den första siffran är kb, sen hela variabeln ger hur många bytes, vald kb är. I detta fall 51200 bytes.
 $max_storlek = 500*1024;
 
 //Väljer vilka filer som kan laddas upp
 $mime_typer = array('image/bmp');
 
 //Sätter ihop vald mapp och filnamn
 $destination = $mapp.$filnamn;
 
 //Kollar om filen har rätt mime typ samt rätt storlek
 if ( in_array ($_FILES["fil"]["type"], $mime_typer) &&
 $_FILES["fil"]["size"] <= $max_storlek ) {
 
     //Lägger upp filen där du valt att den ska hamna
     move_uploaded_file($_FILES["fil"]["tmp_name"], $destination);
     echo "Din fil laddades upp utan problem , $mapp <br> <img src=\"" . $mapp . $filnamn . "\">";
 
 }
 else {
 
 //Visar att något är fel, och skriver ut lite information om filen
 echo "Ett fel uppstod vid uppladdningen.<br />";
 echo "Din fil är ".(ceil($_FILES["fil"]["size"]/1024))." kb stor, maxstorleken är ".($max_storlek/1024)." kb.<br />";
 echo "Din filtyp är ".$_FILES["fil"]["type"].", de mime typer som stödjs är följande: <br />";
 
 //Listar upp alla filtyper som står i $mime_typer
 foreach($mime_typer as $stodjs)
 echo $stodjs.'<br />';
 
 }
 ?> 
