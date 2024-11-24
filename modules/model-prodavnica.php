<?php
if (!$db) {
    die("Greška pri povezivanju sa bazom.");
}

$_page_view['view_filename'] = DIR_VIEW . 'view-prodavnica.php';

function getMarke($db) {
    $sql = "SELECT DISTINCT marka FROM vozila"; 
    $result = mysqli_query($db, $sql);
    $markaDropdown = '<select name="marka">';
    $markaDropdown .= '<option value="" disabled selected hidden>Sve marke</option>';
    $markaDropdown .= '<option value="">Sve marke</option>'; 
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $marka = htmlspecialchars($row['marka']);
            $markaDropdown .= "<option value=\"$marka\">$marka</option>";
        }
    }
    $markaDropdown .= '</select>';
    if (!$result || mysqli_num_rows($result) === 0) {
        $markaDropdown = '<p>Trenutno nema dostupnih marki.</p>';
    }

    return $markaDropdown;
}
function getModel($db) {
    $sql = "SELECT DISTINCT model FROM vozila"; 
    $result = mysqli_query($db, $sql);
    $modelDropdown = '<select name="model">';
    $modelDropdown .= '<option value="" disabled selected hidden>Svi modeli</option>';
    $modelDropdown .= '<option value="">Svi modeli</option>'; 
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $model = htmlspecialchars($row['model']);
            $modelDropdown .= "<option value=\"$model\">$model</option>";
        }
    }
    $modelDropdown .= '</select>';
    if (!$result || mysqli_num_rows($result) === 0) {
        $modelDropdown = '<p>Trenutno nema dostupnih marki.</p>';
    }

    return $modelDropdown;
}
function getGorivo($db) {
    $sql = "SELECT DISTINCT vrsta_goriva FROM vozila"; 
    $result = mysqli_query($db, $sql);
    $gorivoDropdown = '<select name="gorivo">';
    $gorivoDropdown .= '<option value="" disabled selected hidden>Vrsta goriva</option>';
    $gorivoDropdown .= '<option value="">Sve</option>'; 
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $gorivo = htmlspecialchars($row['vrsta_goriva']);
            $gorivoDropdown .= "<option value=\"$gorivo\">$gorivo</option>";
        }
    }
    $gorivoDropdown .= '</select>';
    if (!$result || mysqli_num_rows($result) === 0) {
        $gorivoDropdown = '<p>Trenutno nema dostupnih marki.</p>';
    }

    return $gorivoDropdown;
}
function getStanje($db) {
    $sql = "SELECT DISTINCT novo_polovno FROM vozila"; 
    $result = mysqli_query($db, $sql);
    $stanjeDropdown = '<select name="stanje">';
    $stanjeDropdown .= '<option value="" disabled selected hidden>Stanje</option>';
    $stanjeDropdown .= '<option value="">Sve</option>'; 
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $stanje = htmlspecialchars($row['novo_polovno']);
            $stanjeDropdown .= "<option value=\"$stanje\">$stanje</option>";
        }
    }
    $stanjeDropdown .= '</select>';
    if (!$result || mysqli_num_rows($result) === 0) {
        $stanjeDropdown = '<p>Trenutno nema dostupnih marki.</p>';
    }

    return $stanjeDropdown;
}

function pretrazi($db, $filteri) {
    // Početak SQL upita
    $sql = "SELECT * FROM vozila WHERE 1=1";

    // Dodavanje filtera samo ako su dostupni
    if (!empty($filteri['marka'])) {
        $marka = mysqli_real_escape_string($db, $filteri['marka']);
        $sql .= " AND marka = '$marka'";
    }

    if (!empty($filteri['model'])) {
        $model = mysqli_real_escape_string($db, $filteri['model']);
        $sql .= " AND model = '$model'";
    }

    if (!empty($filteri['gorivo'])) {
        $gorivo = mysqli_real_escape_string($db, $filteri['gorivo']);
        $sql .= " AND vrsta_goriva = '$gorivo'";
    }

    if (!empty($filteri['stanje'])) {
        $stanje = mysqli_real_escape_string($db, $filteri['stanje']);
        $sql .= " AND novo_polovno = '$stanje'";
    }

    if (!empty($filteri['cena_od'])) {
        $cenaOd = (int) $filteri['cena_od'];
        $sql .= " AND cena >= $cenaOd";
    }

    if (!empty($filteri['cena_do'])) {
        $cenaDo = (int) $filteri['cena_do'];
        $sql .= " AND cena <= $cenaDo";
    }

    if (!empty($filteri['km_od'])) {
        $kmOd = (int) $filteri['km_od'];
        $sql .= " AND predjeni_kilometri >= $kmOd";
    }

    if (!empty($filteri['km_do'])) {
        $kmDo = (int) $filteri['km_do'];
        $sql .= " AND predjeni_kilometri <= $kmDo";
    }

    if (!empty($filteri['snaga'])) {
        $snaga = (int) $filteri['snaga'];
        $sql .= " AND snaga_motora >= $snaga";
    }

    // Izvršavanje upita
    $result = mysqli_query($db, $sql);
    $output = "";

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<div>";
            $output .= "Marka: " . htmlspecialchars($row['marka']) . "<br>";
            $output .= "Model: " . htmlspecialchars($row['model']) . "<br>";
            $output .= "Cena: " . htmlspecialchars($row['cena']) . " €<br>";
            $output .= "Kilometraža: " . htmlspecialchars($row['predjeni_kilometri']) . " km<br>";
            $output .= "Snaga: " . htmlspecialchars($row['snaga_motora']) . " kW<br>";
            $output .= "</div><hr>";
        }
    } else {
        $output = "<p>Nema rezultata za zadate filtere.</p>";
    }

    return $output;
}




?>


