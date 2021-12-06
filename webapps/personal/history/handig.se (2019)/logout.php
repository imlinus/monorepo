<?php
  $_SESSION['admin']=FALSE;
  session_destroy();
  relocate("./");
?>