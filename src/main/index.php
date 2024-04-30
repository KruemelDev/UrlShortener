<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
