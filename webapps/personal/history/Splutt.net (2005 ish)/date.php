<html>
<?php
$x = 0;

if (date("F") == "January") { $md = 31;
}
elseif (date("F") == "February") { $md = 28;
}
elseif (date("F") == "March") { $md = 31;
}
elseif (date("F") == "April") { $md = 30;
}
elseif (date("F") == "May") { $md = 31;
}
elseif (date("F") == "June") { $md = 30;
}
elseif (date("F") == "Juli") { $md = 31;
}
elseif (date("F") == "August") { $md = 31;
}
elseif (date("F") == "September") { $md = 30;
}
elseif (date("F") == "October") { $md = 31;
}
elseif (date("F") == "November") { $md = 30;
}
elseif (date("F") == "December") { $md = 31;
}

echo $md;
echo "<br>";
echo date("m, D, F, W, M d, Y H:i:s", time());
echo "<br>";

if (date(D) == "Mon")
{
$x = "Måndag";
$z = date(d);
}
elseif (date(D) == "Tue")
{
$x = "Tisdag";
$z = date(d) - 1;
}
elseif (date(D) == "Wed")
{
$x = "Onsdag";
$z = date(d) - 2;
}
elseif (date(D) == "Thu")
{
$x = "Torsdag";
$z = date(d) - 3;
}
elseif (date(D) == "Fri")
{
$x = "Fredag";
$z = date(d) - 4;
}
elseif (date(D) == "Sat")
{
$x = "Lördag";
$z = date(d) - 5;
}
elseif (date(D) == "Sun")
{
$x = "Söndag";
$z = date(d) - 6;
}



$dag1 = $z;
$dag2 = $z + 1;
$dag3 = $z + 2;
$dag4 = $z + 3;
$dag5 = $z + 4;
$dag6 = $z + 5;
$dag7 = $z + 6;
$dag8 = $z + 7;
$dag9 = $z + 8;
$dag10 = $z + 9;
$dag11 = $z + 10;
$dag12 = $z + 11;
$dag13 = $z + 12;
$dag14 = $z + 13;

if ($dag14 >= $md + 1)
{
echo "Error!";
}

echo $x;
echo "<br><br>";
echo "<H1>";
echo date(W);
echo "</H1>";
echo "<hr><br>";
echo $dag1."<br>"."Måndag";
echo "<br><hr><br>";
echo $dag2."<br>"."Tisdag";
echo "<br><hr><br>";
echo $dag3."<br>"."Onsdag";
echo "<br><hr><br>";
echo $dag4."<br>"."Torsdag";
echo "<br><hr><br>";
echo $dag5."<br>"."Fredag";
echo "<br><hr><br>";
echo $dag6."<br>"."Lördag";
echo "<br><hr><br>";
echo $dag7."<br>"."Söndag";
echo "<br><hr><br>";
echo $dag8."<br>"."Måndag";
echo "<br><hr><br>";
echo $dag9."<br>"."Tisdag";
echo "<br><hr><br>";
echo $dag10."<br>"."Onsdag";
echo "<br><hr><br>";
echo $dag11."<br>"."Torsdag";
echo "<br><hr><br>";
echo $dag12."<br>"."Fredag";
echo "<br><hr><br>";
echo $dag13."<br>"."Lördag";
echo "<br><hr><br>";
echo $dag14."<br>"."Söndag";
echo "<br><hr><br>";



?>


<!--
<hr>
<?php echo date(d); ?>
<br> Idag händer massor!
<hr>
<?php $dagtva = date(d) + 1; echo $dagtva; ?>
<br><br>
<?php


echo date("D, F, W, M d, Y H:i:s", time()); 

?> 
-->