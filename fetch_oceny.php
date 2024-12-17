<?php
$conn = mysqli_connect("localhost", "root", "", "dziennik");

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

$uzytkownik_id = $_GET['uzytkownik_id'] ?? null;
$przedmiot_id = $_GET['przedmiot_id'] ?? null;

if (!$uzytkownik_id || !$przedmiot_id) {
    die("Nieprawidłowe dane wejściowe.");
}

// Zapytanie SQL: Pobranie ocen dla określonego użytkownika i przedmiotu
$zapytanie = "SELECT ocena.ocena, tabela_glowna.opis 
              FROM tabela_glowna
              INNER JOIN ocena ON tabela_glowna.ocena_id = ocena.ocena_id
              WHERE tabela_glowna.uzytkownik_id = '$uzytkownik_id' 
              AND tabela_glowna.przedmiot_id = '$przedmiot_id'";

$result = mysqli_query($conn, $zapytanie);

if (!$result) {
    die("Błąd zapytania: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Wyświetlenie oceny i opisu
        echo "Ocena: " . htmlspecialchars($row['ocena']) . "<br>";
        echo "Opis: " . htmlspecialchars($row['opis']) . "<hr>";
    }
} else {
    echo "Brak ocen dla wybranego przedmiotu.";
}

mysqli_close($conn);
?>
