<html>
<head>
    <link rel="stylesheet" type="text/css" href="beregner.css">
</head>
<body>
    <p>Udfyld alle felter og beregn din DPS (Damage per second)</p>
    <form method="POST" action="/phpopgaver/beregner.php">
        <div class="flex col">
            <div class="form-group">
                <label for="minDamage">Minimum damage per hit</label>
                <input id="minDamage" name="minDamage" class="form-input" type="number" min="0"
                    value="<?php echo isset($_POST['minDamage']) ? $_POST['minDamage'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="maxDamage">Maximum damage per hit</label>
                <input id="maxDamage" name="maxDamage" class="form-input" type="number" min="0"
                    value="<?php echo isset($_POST['maxDamage']) ? $_POST['maxDamage'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="atkSpeed">Attack speed i hits per sekund (Tillader decimal tal)</label>
                <input id="atkSpeed" name="atkSpeed" class="form-input" type="number" min="0" step="any"
                    value="<?php echo isset($_POST['atkSpeed']) ? $_POST['atkSpeed'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="hitChance">Hit chance i procent</label>
                <input id="hitChance" name="hitChance" class="form-input" type="number" min="0"
                    value="<?php echo isset($_POST['hitChance']) ? $_POST['hitChance'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="critChance">Critical hit chance (2x damage) i procent</label>
                <input id="critChance" name="critChance" class="form-input" type="number" min="0"
                    value="<?php echo isset($_POST['critChance']) ? $_POST['critChance'] : '' ?>">
            </div>
            <button class="form-submit" type="submit">Beregn</button>
        </div>

    </form>
</body>

</html>

<?php
    $required = array("minDamage", "maxDamage", "atkSpeed", "hitChance", "critChance");

    $error = false;
    $formSubmitted = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        } else {
            $formSubmitted = true;
        }
    }

    if (!$formSubmitted) {
        return;
    } else if ($error) {
        echo "Fejl: Alle felter skal udfyldes";
    } else {
        $minDamage = $_POST["minDamage"];
        $maxDamage = $_POST["maxDamage"];
        $atkSpeed = $_POST["atkSpeed"];
        $hitChance = $_POST["hitChance"];
        $critChance = $_POST["critChance"];

        $hitChanceMultiplier = $hitChance / 100;
        $base = (($minDamage + $maxDamage) / 2) * $atkSpeed * $hitChanceMultiplier;
        $critPercent = $critChance / 100;
        $withCrit = ($base * (1 - $critPercent)) + (2 * ($base * $critPercent));

        echo "Din teoritiske gennemsnits DPS er: </br>";
        echo "$withCrit DPS";
    }
?>