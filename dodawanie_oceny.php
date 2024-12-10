<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie oceny</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

    

    <form action="" method="post">
        <h2>Wpisz ocene</h2><br><input name="ocena" type="text" class="password"><br>
        <input type="submit" name="submit" value="Dodaj" class="submit"><br><br>
    

    <?php
    // Połączenie z bazą danych
    $conn = mysqli_connect("localhost", "root", "", "dziennik");
   
    if (isset($_POST['submit'])) {
        $ocena = $_POST['ocena'];


        if ($ocena == "") {
            echo "Proszę podać ocenę.";
        } elseif ($ocena < 1 || $ocena > 6) {
            echo "Ocena musi być z zakresu 1-6.";
        } else {
            
            $zapytanie = "INSERT INTO ocena (ocena) VALUES ('$ocena')";
            if (mysqli_query($conn, $zapytanie)) {
                echo "Ocena została dodana";
            } else {
                echo "Błąd podczas dodawania oceny: ";
            }
        }
    }
    
    
    
    ?>
    </form>
    </div>
</body>
</html>
