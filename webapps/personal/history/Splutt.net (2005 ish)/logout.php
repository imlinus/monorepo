<?php
// startar sessionen
session_start();

// om anv�ndaren �r inloggad avslutas denna session h�r
if (isset($_SESSION["inloggning"])) {
unset($_SESSION["inloggning"]);
}

// n�r utloggningen �r klar visas loginsidan igen
header("Location: index.php");
?>