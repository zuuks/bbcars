<?php
if($_SESSION['login_status'] ?? '' == true && is_admin()){
    $_page_view['view_filename'] = DIR_VIEW . 'view-korisnici.php';
}else{
    redirect(URL_INDEX . '?module=login&action=login');
}

require 'config.php';

// Povezivanje sa bazom
$conn = new mysqli(
    $config['hostname'],
    $config['username'],
    $config['password'],
    $config['db_name']
);

// Provera konekcije
if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}

// Poruka za banovanje korisnika
$message = "";
if (isset($_POST['ban_user'])) {
    $user_id = intval($_POST['user_id']);

    // Provera user_level-a korisnika koji se pokušava banovati
    $check_sql = "SELECT user_level FROM users WHERE id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $user_id);
    $stmt_check->execute();
    $stmt_check->bind_result($user_level);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($user_level == 1) {
        $message = "Ne možete banovati druge admine.";
    } else {
        // Banovanje korisnika
        $delete_sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $message = "Korisnik uspešno banovan!";
        } else {
            $message = "Došlo je do greške prilikom banovanja korisnika: " . $conn->error;
        }
        $stmt->close();
    }
}

// Učitavanje korisnika
$sql = "SELECT id, username, user_level FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Greška u SQL upitu: " . $conn->error);
}


// Broj korisnika po stranici
$usersPerPage = 10;

// Trenutna stranica
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Osigurajte da stranica ne može biti manja od 1

// Izračunajte početnu poziciju za LIMIT
$start = ($page - 1) * $usersPerPage;

// Ukupno korisnika u bazi
$totalUsersQuery = $db->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = $totalUsersQuery->fetch_assoc()['total'];

// Izračunajte ukupan broj stranica
$totalPages = ceil($totalUsers / $usersPerPage);

// Dohvat korisnika za trenutnu stranicu
$result = $db->query("SELECT * FROM users LIMIT $start, $usersPerPage");



?>
