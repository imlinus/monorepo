<html>

<head>

<title></title>

</head> 
  <frameset rows="60,*" frameborder="NO" border="0" framespacing="0">
       <frame name="topFrame" src="finns.html" scrolling="no"  frameborder="NO" border="0" framespacing="0" >



<?php



if (isset($_GET['frame'])) {

        echo "<frame name=\"mainFrame\" src=\"";
        echo $_GET['frame'];
        echo "\">";

    } else {

        echo "Bruten länk...";

    }














?>
    
  </frameset>
  </frameset>
</frameset>



</html>