<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular</title>
</head>
<body>
<h2>Formular</h2>

<?php
    // Hier beginnt der PHP-Code
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verarbeite das Formular, nachdem Daten gesendet wurden
        $name = $_POST["name"];
        $email = $_POST["email"];

        // Führe hier weitere Aktionen mit den gesendeten Daten aus, z. B. Speichern in einer Datenbank

        // Beispiel: Ausgabe der gesendeten Daten
        echo "Name: " . $name . "<br>";
echo "E-Mail: " . $email;
}
// Hier endet der PHP-Code
?>

<!-- Das Formular sendet die Daten an dieselbe Seite (index.php) mit der POST-Methode -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<label for="name">Name:</label><br>
<input type="text" id="name" name="name"><br>
<label for="email">E-Mail:</label><br>
<input type="email" id="email" name="email"><br><br>
<input type="submit" value="Absenden">
</form>
</body>
</html>
