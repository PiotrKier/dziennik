<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['grades'])) {
    $grades = $_POST['grades'];

    foreach ($grades as $userId => $subjects) {
        foreach ($subjects as $subjectId => $grade) {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO tabela_glowna (uzytkownik_id, przedmiot_id, ocena_id)
                    VALUES (:userId, :subjectId, :gradeId)
                    ON DUPLICATE KEY UPDATE ocena_id = :gradeId
                ");
                $stmt->execute([
                    ':userId' => $userId,
                    ':subjectId' => $subjectId,
                    ':gradeId' => $grade
                ]);
            } catch (PDOException $e) {
                echo "Błąd zapisu: " . $e->getMessage();
            }
        }
    }

    echo "Oceny zostały zapisane.";
} else {
    echo "Brak danych do zapisania.";
}
?>
