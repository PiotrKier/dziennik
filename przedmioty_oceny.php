<?php
$conn = mysqli_connect("localhost", "root", "", "dziennik");

if (!$conn) {
    die("Brak połączenia z bazą danych.");
}

$uzytkownik_id = $_GET['uzytkownik_id'] ?? null;

if (!$uzytkownik_id) {
    die("Niepoprawny identyfikator użytkownika.");
}

// Pobranie listy przedmiotów
$przedmioty_query = "SELECT * FROM przedmiot";
$przedmioty_result = mysqli_query($conn, $przedmioty_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceny Uczniów</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #eef5e4;
            color: #2f4d2f;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            display: flex;
            background: #f8fff5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            width: 80%;
            max-width: 1200px;
        }
        .subjects, .grades {
            padding: 20px;
        }
        .subjects {
            background-color: #daf3c2;
            width: 30%;
            text-align: center;
        }
        .subjects h3 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #2e6a2e;
        }
        .subjects select, .subjects button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2f4d2f;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .grades {
            width: 70%;
            background-color: #f8fff5;
        }
        .grades h3 {
            margin-bottom: 20px;
            color: #2e6a2e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #c4e4b5;
            text-align: center;
        }
        table th {
            background-color: #daf3c2;
            color: #2e6a2e;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #2f4d2f;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
    <script>
        function fetchGrades(przedmiot_id) {
            const uzytkownik_id = <?php echo json_encode($uzytkownik_id); ?>;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch_oceny.php?uzytkownik_id=${uzytkownik_id}&przedmiot_id=${przedmiot_id}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("grades").innerHTML = xhr.responseText;
                } else {
                    document.getElementById("grades").innerHTML = "<p>Wystąpił błąd podczas pobierania ocen.</p>";
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="subjects">
            <h3>Oceny uczniów</h3>
            <select onchange="fetchGrades(this.value)">
                <option value="">Wybierz przedmiot</option>
                <?php while ($row = mysqli_fetch_assoc($przedmioty_result)): ?>
                    <option value="<?php echo $row['przedmiot_id']; ?>">
                        <?php echo htmlspecialchars($row['przedmiot']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <a href="index.php" class="back-link">Powrót do strony głównej</a>
        </div>
        <div class="grades" id="grades">
            <h3>Oceny uczniów</h3>
            <p>Wybierz przedmiot, aby wyświetlić oceny.</p>
        </div>
    </div>
</body>
</html>
