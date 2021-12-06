<?php
// startar sessionen
session_start();

// om användaren är inloggad avslutas denna session här
if (isset($_SESSION["inloggning"])) {
unset($_SESSION["inloggning"]);
}

// när utloggningen är klar visas loginsidan igen
header("Location: index.php");
?>