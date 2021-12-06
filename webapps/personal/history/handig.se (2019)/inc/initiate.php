<?php
// Are we in production? If so, turn off the error reporting
if($production == false) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
} else {
  ini_set('display_errors', 0);
}

// Sorry, what time is it?
$today = date("Y-m-d H:i:s");

// Some important settings we gonna use throughout the page
define('BASEURL', 'http://whateverrr.com/albinhandig');
define('DOMAIN', '.localhost:8888');
define("NOW", "".$today."");

// Make sure nobodys trying to f#&k with us
if (get_magic_quotes_gpc()) {
    function strip_array($var) {
        return is_array($var)? array_map("strip_array", $var):stripslashes($var);
    }
    $_POST = strip_array($_POST);
    $_SESSION = strip_array($_SESSION);
    $_GET = strip_array($_GET);
    $_REQUEST = strip_array($_REQUEST);
    $_COOKIE = strip_array($_COOKIE);
}

// Connect to the glorious database
function db() {
    static $connection;
    if(!isset($connection)) {
        $db = parse_ini_file('config.ini');
        $connection = mysqli_connect('localhost', $db['username'], $db['password'], $db['database']);
    }
    if($connection === false) {
        return mysqli_connect_error();
    }
    return $connection;
}

// Now a few shorthand functions to talk with the database
function db_query($query) {
    $connection = db();
    $result = mysqli_query($connection, $query);
    return $result;
}

function db_error() {
    $connection = db();
    return mysqli_error($connection);
}

function escape($value) {
  $value = trim($value);
  $value = str_replace(array("<",">",'"', "'", ";"),"",$value);
  return $value;
}


// shorthand function for header location
function relocate($url) {
  if ($url == -1) $url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "/";
  Header("Location: $url");
  die();
}

// Get the page header and footer
function get_head() {
  if (file_exists("inc/header.php")) {
    require ("inc/header.php");
  }
}

function get_foot() {
  if (file_exists("inc/footer.php")) {
    require ("inc/footer.php");
  }
}

// and the page of course
function get_page() {
  $uri = explode('/', $_SERVER['REQUEST_URI']);

  if (sizeof($uri) > 1 && !empty($uri[1])) {
    $post = $uri[1];
  } else {
    $post = "start";
  }

  $get = escape(preg_replace('/[^a-z0-9-_]/i','', $post));
  $disallowed_urls = array('initiate', 'header', 'footer', 'signin');

  if (in_array($get, $disallowed_urls)) {
    $get = 'start';
  }

  if (file_exists('page/'.$get.'.php')) {
    include ('page/'.$get.'.php');
  } else {
    include ('page/404.php');
  }
}

?>