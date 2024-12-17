<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dziennik nauczyciel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        button{
            margin:20px;
            color:white;
            font-size:15px;
        }
        select{
            border-radius:10px;
            height:30px;
            width:140px;
            border:0px;
            background-color:none;
            font-weight:500;
            font-size:15px;
            color:#2e7d32;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Wybierz klasę</h1>
        <form action="edycja_ocen.php" method="GET">
            <select name="class" required>
                <option value="" disabled selected>Wybierz klasę...</option>
                <option value="1">1A</option>
                <option value="2">1B</option>
                <option value="3">1C</option>
                <option value="4">2A</option>
                <option value="5">2B</option>
                <option value="6">2C</option>
                <option value="7">3A</option>
                <option value="8">3B</option>
                <option value="9">3C</option>
            </select><br>
            <button type="submit">Przejdź do edycji</button><br>
            <a href='index.php' class=back>Powrót do strony głównej</a>
        </form>
    </div>
</body>
</html>
