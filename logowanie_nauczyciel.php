<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
    <form action="" method="post">
        
        <h1>Podaj dane</h1>
        <input name="imie" class="password" placeholder="imie">
        <br>
        <input name="nazwisko" class="password" placeholder="nazwisko">
        <br>
        <input name="password" class="password" placeholder="password">
        <br>
        <input type="submit" value="zaloguj" name="submit" class="submit"><br>
        <?php
    $conn = mysqli_connect("localhost", "root", "", "dziennik");
    
    if (!$conn) {
        echo "Brak połączenia z bazą danych.";
    }

    if (isset($_POST['submit'])) {
        $password = $_POST['password']; 
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $edycja=1;
        $zapytanie = "SELECT imie, nazwisko, edycja FROM uzytkownik WHERE haslo = '$password' AND imie = '$imie' AND nazwisko = '$nazwisko'";

        $wynik = mysqli_query($conn, $zapytanie);

        if ($wynik) {
            $row = mysqli_fetch_assoc($wynik); 
            if ($row) { 
                if ($row['edycja'] == 0) {
                    echo "Niepoprawne dane logowania";
                } else {
                    echo "Zalogowano jako : <br><b>" . htmlspecialchars($row['imie']) . " " . htmlspecialchars($row['nazwisko']) . "<br>";
                    echo '<script>
                    setTimeout(() => {
                        window.location.href = "dziennik_nauczyciel.php";
                    }, 1200); 
                  </script>';
                }
            } else {
                echo "Niepoprawne dane logowania";
            }
        }
        
    }
    ?>
        <a href='index.php' class=back>Powrót do strony głównej</a>
        
    </form>
    </div>
    
   
</body>
</html>