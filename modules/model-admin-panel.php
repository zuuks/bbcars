<?php
if($_SESSION['login_status'] ?? '' == true && is_admin()){
    $_page_view['view_filename'] = DIR_VIEW . 'view-admin-panel.php';
}else{
    redirect(URL_INDEX . '?module=login&action=login');
}
require 'config.php';


if (isset($_GET['action']) && $_GET['action'] == 'export') {
  
    $sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri, prodato_vozilo FROM vozila";
    $result = mysqli_query($db, $sql);
    
    $vehicles = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }

      
        $json_data = json_encode($vehicles, JSON_PRETTY_PRINT);

     
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="vozila.json"');
        
    
        echo $json_data;

        exit; 
    } else {
        echo "Nema podataka za eksportovanje.";
    }
}


$items_per_page = 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $items_per_page;


$sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri, vrsta_goriva, kubikaza, snaga_motora, novo_polovno, uvoz_domace, prodato_vozilo FROM vozila LIMIT $start_from, $items_per_page";

$result = mysqli_query($db, $sql);

$total_sql = "SELECT COUNT(*) AS total FROM vozila";
$total_result = mysqli_query($db, $total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);
?>
