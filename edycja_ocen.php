<?php
// Połączenie z bazą danych
$host = 'localhost';
$dbname = 'dziennik';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia: " . $e->getMessage());
}

$message = "";

// Pobranie klasy z GET
$idKlasy = $_GET['class'] ?? null;

if (!$idKlasy) {
    die("Nie wybrano klasy. Wróć do strony wyboru klasy.");
}

// Pobranie listy przedmiotów
$przedmiotyQuery = $pdo->query("SELECT * FROM przedmiot");
$przedmioty = $przedmiotyQuery->fetchAll(PDO::FETCH_ASSOC);

// Pobranie ocen z tabeli "ocena"
$ocenyQuery = $pdo->query("SELECT * FROM ocena");
$listaOcen = $ocenyQuery->fetchAll(PDO::FETCH_ASSOC);

// Pobranie id_przedmiotu z GET
$idPrzedmiotu = $_GET['przedmiot_id'] ?? null;

// Dodanie oceny
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uzytkownik_id'], $_POST['ocena_id'], $_POST['opis'])) {
    $uzytkownikId = $_POST['uzytkownik_id'];
    $ocenaId = $_POST['ocena_id'];
    $opis = $_POST['opis'];

    $stmt = $pdo->prepare("INSERT INTO tabela_glowna (uzytkownik_id, ocena_id, opis, przedmiot_id) VALUES (:uzytkownik_id, :ocena_id, :opis, :przedmiot_id)");
    $stmt->execute([
        ':uzytkownik_id' => $uzytkownikId,
        ':ocena_id' => $ocenaId,
        ':opis' => $opis,
        ':przedmiot_id' => $idPrzedmiotu
    ]);
    $message = "Ocena została dodana.";
}

// Usuwanie oceny
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $idOceny = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM tabela_glowna WHERE id = :id");
    $stmt->execute([':id' => $idOceny]);
    $message = "Ocena została usunięta.";
}

// Edycja oceny
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'], $_POST['ocena_id'], $_POST['opis'])) {
    $editId = $_POST['edit_id'];
    $ocenaId = $_POST['ocena_id'];
    $opis = $_POST['opis'];

    $stmt = $pdo->prepare("UPDATE tabela_glowna SET ocena_id = :ocena_id, opis = :opis WHERE id = :id");
    $stmt->execute([
        ':ocena_id' => $ocenaId,
        ':opis' => $opis,
        ':id' => $editId
    ]);
    $message = "Ocena została zaktualizowana.";
}

// Pobranie uczniów z wybranej klasy oraz ich ocen dla wybranego przedmiotu
$oceny = [];
$uczniowie = [];
if ($idPrzedmiotu) {
    $stmt = $pdo->prepare("
        SELECT tg.id, tg.ocena_id, tg.opis, u.imie, u.drugie_imie, u.nazwisko, tg.uzytkownik_id
        FROM tabela_glowna tg
        JOIN uzytkownik u ON tg.uzytkownik_id = u.uzytkownik_id
        WHERE tg.przedmiot_id = :przedmiot_id AND u.id_klasy = :id_klasy
    ");
    $stmt->execute([':przedmiot_id' => $idPrzedmiotu, ':id_klasy' => $idKlasy]);
    $oceny = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $uczniowieQuery = $pdo->prepare("SELECT * FROM uzytkownik WHERE id_klasy = :id_klasy");
    $uczniowieQuery->execute([':id_klasy' => $idKlasy]);
    $uczniowie = $uczniowieQuery->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Oceny uczniów</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #28a745; /* Zielony kolor nagłówka */
            padding: 20px;
            background-color: #fff;
            margin-bottom: 20px;
            border-bottom: 3px solid #28a745;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #28a745; /* Zielona obramówka */
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        td {
            background-color: #fff;
        }

        button {
            background-color: #28a745; /* Zielony przycisk */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838; /* Ciemniejszy zielony po najechaniu */
        }

        select, input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #28a745; /* Zielona obramówka */
            border-radius: 5px;
            margin: 5px 0;
        }

        form {
            margin: 20px 0;
            text-align: center;
        }

        .message {
            color: #28a745; /* Zielona wiadomość */
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Oceny uczniów z klasy <?php echo htmlspecialchars($idKlasy); ?></h1>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Wybór przedmiotu -->
    <form method="GET">
        <input type="hidden" name="class" value="<?php echo htmlspecialchars($idKlasy); ?>">
        <select name="przedmiot_id" required>
            <option value="" disabled selected>Wybierz przedmiot</option>
            <?php foreach ($przedmioty as $przedmiot): ?>
                <option value="<?php echo $przedmiot['przedmiot_id']; ?>" <?php echo ($idPrzedmiotu == $przedmiot['przedmiot_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($przedmiot['przedmiot']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Pokaż</button>
    </form>

    <?php if ($idPrzedmiotu): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Oceny</th>
                <th>Dodaj/Edytuj ocenę</th>
            </tr>
            <?php foreach ($uczniowie as $uczen): ?>
                <tr>
                    <td>
                        <?php 
                            echo htmlspecialchars($uczen['imie'] . ' ' . ($uczen['drugie_imie'] ? $uczen['drugie_imie'] . ' ' : '') . $uczen['nazwisko']); 
                        ?>
                    </td>
                    <td>
                        <?php 
                            foreach ($oceny as $ocena) {
                                if ($ocena['uzytkownik_id'] == $uczen['uzytkownik_id']) {
                                    // Pobieramy nazwę oceny z tabeli "ocena"
                                    $ocenaName = "";
                                    foreach ($listaOcen as $listaOcena) {
                                        if ($listaOcena['ocena_id'] == $ocena['ocena_id']) {
                                            $ocenaName = $listaOcena['ocena'];
                                            break;
                                        }
                                    }
                                    echo "Ocena: " . htmlspecialchars($ocenaName) . " - Opis: " . htmlspecialchars($ocena['opis']);
                                    echo " <form method='POST' style='display:inline;'>
                                            <input type='hidden' name='delete_id' value='{$ocena['id']}'>
                                            <button type='submit'>Usuń</button>
                                        </form><br>";
                                    // Formularz edycji oceny
                                    echo "<form method='POST'>
                                            <input type='hidden' name='edit_id' value='{$ocena['id']}'>
                                            <select name='ocena_id' required>";
                                    foreach ($listaOcen as $listaOcena) {
                                        $selected = ($listaOcena['ocena_id'] == $ocena['ocena_id']) ? 'selected' : '';
                                        echo "<option value='{$listaOcena['ocena_id']}' $selected>{$listaOcena['ocena']}</option>";
                                    }
                                    echo "</select>
                                            <input type='text' name='opis' value='" . htmlspecialchars($ocena['opis']) . "' placeholder='Opis oceny'>
                                            <button type='submit'>Edytuj</button>
                                        </form>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="uzytkownik_id" value="<?php echo $uczen['uzytkownik_id']; ?>">
                            <select name="ocena_id" required>
                                <option value="" disabled selected>Wybierz ocenę</option>
                                <?php foreach ($listaOcen as $ocena): ?>
                                    <option value="<?php echo $ocena['ocena_id']; ?>">
                                        <?php echo htmlspecialchars($ocena['ocena']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" name="opis" placeholder="Opis oceny">
                            <button type="submit">Dodaj</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
