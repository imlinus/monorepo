<?php

$till = $_POST['till'];
$till = $_POST['namn'];
$text = $_POST['text'];





mail($till, $namn, $text);

echo '<script>alert(\'Tack f�r ditt meddelande.\'); setTimeout("history.go(-1)",100); </script>';





?>