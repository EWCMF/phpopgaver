<?php
// Start the session
session_start();
?>
<html>
<body>

<?php


if (!isset($_SESSION["fornavn"])) {
    echo "Intet navn i session";
} else {
    $tidligereNavn = $_SESSION["fornavn"] . " " . $_SESSION["efternavn"];
    echo "Tidligere navn i session: $tidligereNavn";
}

echo "<br><br>";

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