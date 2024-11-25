<?php
if($_SESSION['login_status'] ?? '' == true && is_admin()){
    $_page_view['view_filename'] = DIR_VIEW . 'view-admin-panel.php';
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

// Proverite da li je zahtev za izvoz
if (isset($_GET['action']) && $_GET['action'] == 'export') {
    // SQL upit za dobijanje svih automobila
    $sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri, prodato_vozilo FROM vozila";
    $result = $conn->query($sql);

    // Kreiranje niza za skladištenje podataka o vozilima
    $vehicles = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }

        // Generisanje JSON-a
        $json_data = json_encode($vehicles, JSON_PRETTY_PRINT);

        // Postavljanje odgovarajućih zaglavlja za preuzimanje JSON fajla
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="vozila.json"');
        
        // Slanje JSON podataka za preuzimanje
        echo $json_data;

        exit; // Završava izvršavanje skripte nakon slanja fajla
    } else {
        echo "Nema podataka za eksportovanje."; // Ispis greške ako nema podataka
    }
}


// Definisanje broja stavki po stranici i trenutne stranice
$items_per_page = 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $items_per_page;

// SQL upit za dobijanje vozila sa paginacijom
$sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri, vrsta_goriva, kubikaza, snaga_motora, novo_polovno, uvoz_domace, prodato_vozilo FROM vozila LIMIT $start_from, $items_per_page";
$result = $conn->query($sql);

// Dobijanje ukupnog broja vozila
$total_sql = "SELECT COUNT(*) AS total FROM vozila";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);
?>
