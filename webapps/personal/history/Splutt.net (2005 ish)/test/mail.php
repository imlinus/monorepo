<?php

$till = $_POST['till'];
$text = $_POST['text'];
$times = $_POST['times'];

if ($till != "erik_gm93@hotmail.com")
{

echo "Skickar mail, v�nligen v�nta...";
echo '<script> setTimeout("history.go(-1)",10000); </script>';


if ($times > 20)
{
echo "Max �r 20 stycken, det skickas nu 20 mail.";
$times = 20;
}

$nrett = "Detta mail �r skickat fr�n en hemsida. Denna kommer inte fr�n 'avs�ndaren' utan fr�n en person som �r som inte vill avsl�ja identitet. Personen har sj�lv valt antalet mail. Detta �r inte spam, eftersom det inte inneh�ller n�gon reklam. Det kan d�remot betraktas som skr�ppost. Detta mail inneh�ller inget farligt, utan bara text.


Personens meddelande:
";




for ($i = 0; $i < $times; $i++)
{
mail($till, "Mail", $nrett . $text);


}

}
else
{
echo "<h2><b>ERROR:</b></h2><br>Det g�r inte att spama admin!"; 
echo '<script> setTimeout("history.go(-1)",1700); </script>';

}

?>