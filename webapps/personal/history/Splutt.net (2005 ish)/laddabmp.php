  <?
 //V�ljer vart bilderna ska hamna
 $mapp = 'images/';
 
 //L�gger in orginalnamnet i en variabel
 $filnamn = $_FILES["fil"]["name"];
 
 //Den f�rsta siffran �r kb, sen hela variabeln ger hur m�nga bytes, vald kb �r. I detta fall 51200 bytes.
 $max_storlek = 500*1024;
 
 //V�ljer vilka filer som kan laddas upp
 $mime_typer = array('image/bmp');
 
 //S�tter ihop vald mapp och filnamn
 $destination = $mapp.$filnamn;
 
 //Kollar om filen har r�tt mime typ samt r�tt storlek
 if ( in_array ($_FILES["fil"]["type"], $mime_typer) &&
 $_FILES["fil"]["size"] <= $max_storlek ) {
 
     //L�gger upp filen d�r du valt att den ska hamna
     move_uploaded_file($_FILES["fil"]["tmp_name"], $destination);
     echo "Din fil laddades upp utan problem , $mapp <br> <img src=\"" . $mapp . $filnamn . "\">";
 
 }
 else {
 
 //Visar att n�got �r fel, och skriver ut lite information om filen
 echo "Ett fel uppstod vid uppladdningen.<br />";
 echo "Din fil �r ".(ceil($_FILES["fil"]["size"]/1024))." kb stor, maxstorleken �r ".($max_storlek/1024)." kb.<br />";
 echo "Din filtyp �r ".$_FILES["fil"]["type"].", de mime typer som st�djs �r f�ljande: <br />";
 
 //Listar upp alla filtyper som st�r i $mime_typer
 foreach($mime_typer as $stodjs)
 echo $stodjs.'<br />';
 
 }
 ?> 
