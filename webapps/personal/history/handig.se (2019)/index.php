<?php
session_start(); // starting our session
$production = false; // set to true if you are going live
ob_start(); // compressing the page is always a smart choice
include("inc/initiate.php"); // get all out page functions
get_head(); // get the header
get_page(); // and the page
get_foot(); // and the footer
ob_end_flush();
?>