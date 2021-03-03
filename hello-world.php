<?php
// Start the session
session_start();
?>
<html>
<body>

<?php


// Det tidligere navn der blev brugt i GET requesten bliver vist her hvis der er et.
// $_SESSION bruges til at gemme det tidligere navn.
if (!isset($_SESSION["fornavn"])) {
    echo "Intet navn i session";
} else {
    $tidligereNavn = $_SESSION["fornavn"] . " " . $_SESSION["efternavn"];
    echo "Tidligere navn i session: $tidligereNavn";
}

echo "<br><br>";

//Både fornavn og efter skal være angivet som queries i URL'en for at navnet bliver vist.
if (!isset($_GET['fornavn']) || !isset($_GET['efternavn'])) {
    echo "Intet navn i GET";
} else {
    $fornavn = $_GET['fornavn'];
    $efternavn = $_GET['efternavn'];

    $_SESSION["fornavn"] = $fornavn;
    $_SESSION["efternavn"] = $efternavn;

    $nuvaerendeNavn = $fornavn . " " . $efternavn;

    echo("Hello $nuvaerendeNavn");
}

?>

</body>
</html>