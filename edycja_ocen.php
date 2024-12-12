<?php
// Sprawdzanie parametru "class"
if (isset($_GET['class']) && is_numeric($_GET['class'])) {
    $classId = $_GET['class'];
} else {
    die("Brak lub nieprawidłowy identyfikator klasy w adresie URL.");
}

// Połączenie z bazą danych
$host = 'localhost';
$dbname = 'dziennik';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}

// Obsługa dodawania oceny
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['student_id'];
    $subjectId = $_POST['subject_id'];
    $gradeId = $_POST['grade_id'];

    if ($studentId && $subjectId && $gradeId) {
        $addGradeQuery = $pdo->prepare("
            INSERT INTO tabela_glowna (uzytkownik_id, ocena_id, przedmiot_id) 
            VALUES (:studentId, :gradeId, :subjectId)
        ");
        $addGradeQuery->execute([
            ':studentId' => $studentId,
            ':gradeId' => $gradeId,
            ':subjectId' => $subjectId
        ]);
        $message = "Ocena została dodana.";
    } else {
        $message = "Wszystkie pola są wymagane.";
    }
}

// Pobieranie uczniów z klasy
$studentsQuery = $pdo->prepare("
    SELECT uzytkownik_id, imie, nazwisko 
    FROM uzytkownik 
    WHERE edycja = 0 AND id_klasy = :classId
");
$studentsQuery->bindParam(':classId', $classId, PDO::PARAM_INT);
$studentsQuery->execute();
$students = $studentsQuery->fetchAll(PDO::FETCH_ASSOC);

// Pobieranie przedmiotów
$subjectsQuery = $pdo->query("SELECT przedmiot_id, przedmiot FROM przedmiot");
$subjects = $subjectsQuery->fetchAll(PDO::FETCH_ASSOC);

// Pobieranie ocen
$gradesQuery = $pdo->query("SELECT ocena_id, ocena FROM ocena");
$grades = $gradesQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Ocen - Klasa <?php echo htmlspecialchars($classId); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .message {
            color: green;
            margin-bottom: 20px;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        form {
            margin-top: 20px;
        }
        select, input, button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            max-width: 300px;
            font-size: 14px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edycja Ocen - Klasa <?php echo htmlspecialchars($classId); ?></h1>

    <?php if (isset($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if (empty($students)): ?>
        <p>Brak uczniów w wybranej klasie.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Dodaj ocenę</th>
            </tr>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['imie']); ?></td>
                    <td><?php echo htmlspecialchars($student['nazwisko']); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['uzytkownik_id']); ?>">
                            <select name="subject_id" required>
                                <option value="" disabled selected>Przedmiot</option>
                                <?php foreach ($subjects as $subject): ?>
                                    <option value="<?php echo htmlspecialchars($subject['przedmiot_id']); ?>">
                                        <?php echo htmlspecialchars($subject['przedmiot']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <select name="grade_id" required>
                                <option value="" disabled selected>Ocena</option>
                                <?php foreach ($grades as $grade): ?>
                                    <option value="<?php echo htmlspecialchars($grade['ocena_id']); ?>">
                                        <?php echo htmlspecialchars($grade['ocena']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Dodaj</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
