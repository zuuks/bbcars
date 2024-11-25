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

// Učitavanje korisnika
$sql = "SELECT id, username, user_level FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Greška u SQL upitu: " . $conn->error);
}
?>
