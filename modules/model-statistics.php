<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbcars"; // Zameni sa stvarnim imenom tvoje baze

// Kreiraj vezu sa bazom
$db = new mysqli($servername, $username, $password, $dbname);

// Proveri vezu
if ($db->connect_error) {
    die("Povezivanje sa bazom nije uspelo: " . $db->connect_error);
}

if($_SESSION['login_status'] ?? '' == true && is_admin()){
    $_page_view['view_filename'] = DIR_VIEW . 'view-admin-panel.php';
}else{
    redirect(URL_INDEX . '?module=login&action=login');
}

// Ispravi SQL upit
$sql = "SELECT marka, COUNT(*) as broj_vozila
        FROM vozila
        WHERE marka != '' AND marka IS NOT NULL
        GROUP BY marka;";

$result = mysqli_query($db, $sql);

if (!$result) {
    die("Greška pri izvršavanju upita: " . mysqli_error($db));
}

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Vraćanje podataka kao JSON
echo json_encode($data);



$db->close();
?>