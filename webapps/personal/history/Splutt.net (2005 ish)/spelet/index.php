<?php





if (isset($_GET['lvl'])) {

    if (file_exists("lvl".$_GET['lvl'].".php")) {

        include "lvl".$_GET['lvl'].".php";

    } else {

                include "lvl1.php";


    }

}
else {

    include "lvl1.php";

}



?>