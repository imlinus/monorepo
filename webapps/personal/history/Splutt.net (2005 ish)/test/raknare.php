<?php 
//equaked counter | version 1.0 
//Copyright © 2001 Earthquake Interactive //Created and coded by Caleb White 
//feel free to give me feed back caleb@equaked.com 
//Version 2 will include referal tracker and much much more look for it soon. 

//please put in your path to count.inc , DO NOT INCLUDE TRAILING SLASH 

$path="raknare.inc"; 

//Code Do not edit below this line 

$file = fopen("$path","r+"); 
$count = fread($file, filesize("raknare.inc")); 
fclose($file); 
$count += 1; 
$file = fopen("$path","w+"); 
fputs($file, $count); 
echo "$count"; 
fclose($file); 

?>