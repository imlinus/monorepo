<?php
session_start();
//include_once ("conn.php");
include ("settings.php");
if(array_key_exists('p', $_GET)) {
   $subPage = $_GET['p'];
} else {
   $subPage = 'start';
}

if(array_key_exists($subPage, $subPages)) {
   $subPagePath = $subPages[$subPage];
} else {
   $subPagePath = '404.php';
}
include("inc_header.php");
include("$subPagePath");
include("inc_footer.php");
?>
