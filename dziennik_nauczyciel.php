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
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        select {
            font-size: 16px;
            padding: 10px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
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
            <button type="submit">Przejdź do edycji</button>
        </form>
    </div>
</body>
</html>
