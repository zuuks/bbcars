<?php
// Povezivanje sa bazom
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbcars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Konekcija nije uspela: ' . $conn->connect_error]));
}

// Dekodiranje JSON podataka
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if ($id) {
    // Priprema i izvršavanje SQL upita za brisanje
    $sql = "DELETE FROM vozila WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Neuspešno brisanje vozila.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID nije prosleđen.']);
}

$conn->close();
?>
