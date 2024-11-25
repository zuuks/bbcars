<?php
if (!$db) {
    die("Greška pri povezivanju sa bazom.");
}

$_page_view['view_filename'] = DIR_VIEW . 'view-prodavnica.php';

function getMarke($db) {
    $sql = "SELECT DISTINCT marka FROM vozila"; 
    $result = mysqli_query($db, $sql);
    $markaDropdown = '<select name="marka" class="selectshop">';
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
    $modelDropdown = '<select name="model" class="selectshop">';
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
    $gorivoDropdown = '<select name="gorivo" class="selectshop">';
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
    $stanjeDropdown = '<select name="stanje" class="selectshop">';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'filter') {
    echo filterVozila($db, $_POST['filters']);
    exit;
}

function filterVozila($db, $filters) {
    $conditions = [];
    $conditions[] = "prodato_vozilo = 0";
    if (!empty($filters['marka'])) {
        $marka = mysqli_real_escape_string($db, $filters['marka']);
        $conditions[] = "marka = '$marka'";
    }
    if (!empty($filters['model'])) {
        $model = mysqli_real_escape_string($db, $filters['model']);
        $conditions[] = "model = '$model'";
    }
    if (!empty($filters['gorivo'])) {
        $gorivo = mysqli_real_escape_string($db, $filters['gorivo']);
        $conditions[] = "vrsta_goriva = '$gorivo'";
    }
    if (!empty($filters['stanje'])) {
        $stanje = mysqli_real_escape_string($db, $filters['stanje']);
        $conditions[] = "novo_polovno = '$stanje'";
    }
    if (!empty($filters['cenaod'])) {
        $cenaod = (float) $filters['cenaod'];
        $conditions[] = "cena >= $cenaod";
    }
    if (!empty($filters['cenado'])) {
        $cenado = (float) $filters['cenado'];
        $conditions[] = "cena <= $cenado";
    }
    if (!empty($filters['kmod'])) {
        $kmod = (int) $filters['kmod'];
        $conditions[] = "predjeni_kilometri >= $kmod";
    }
    if (!empty($filters['kmdo'])) {
        $kmdo = (int) $filters['kmdo'];
        $conditions[] = "predjeni_kilometri <= $kmdo";
    }
    if (!empty($filters['snaga'])) {
        $snaga = (int) $filters['snaga'];
        $conditions[] = "snaga_motora >= $snaga";
    }

    $whereClause = $conditions ? "WHERE " . implode(' AND ', $conditions) : "";
    $sql = "SELECT * FROM vozila $whereClause";

    $result = mysqli_query($db, $sql);
    $output = '';

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $slika = htmlspecialchars($row['slika']); // Obezbeđujemo sigurnu putanju
            $id = htmlspecialchars($row['id']); // ID iz baze za dinamički URL
            $output .= '<div class="vozilo">';
            $output .= '<div class="slikaVozilo" style="background-image: url(\'' . $slika . '\'); background-size: cover; background-position: center; width: 300px; height: 200px; border-radius:10px 10px 0px 0px;">';
            $output .= '</div>';
            $output .= '<div class="podaciVozilo">';
            $output .= '<h2>' . htmlspecialchars($row['marka'] . ' ' . $row['model']) . '</h2>';
            $output .= '<h3>Cena: €' . htmlspecialchars($row['cena']) . '</h3>';
            $output .= '<p>Godiste: ' . htmlspecialchars($row['godiste']) . '</p>';
            $output .= '<a href="index.php?module=salon&id=' . $id . '" id="kliknaauto" class="dugmezaKola">Pogledaj</a>';
            $output .= '</div>';
            $output .= '</div>';
        }
    } else {
        $output = '<p>Nema rezultata za zadate kriterijume.</p>';
    }

    return $output;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'getModels') {
    $marka = $_POST['marka'];
    echo getModelsByMarka($db, $marka);
    exit;
}

function getModelsByMarka($db, $marka) {
    $marka = mysqli_real_escape_string($db, $marka);
    $sql = $marka 
        ? "SELECT DISTINCT model FROM vozila WHERE marka = '$marka'"
        : "SELECT DISTINCT model FROM vozila";
    
    $result = mysqli_query($db, $sql);
    $modelDropdown = '<option value="" disabled selected hidden>Svi modeli</option>';
    $modelDropdown .= '<option value="">Svi modeli</option>';

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $model = htmlspecialchars($row['model']);
            $modelDropdown .= "<option value=\"$model\">$model</option>";
        }
    } else {
        $modelDropdown = '<option value="">Nema dostupnih modela</option>';
    }

    return $modelDropdown;
}



?>


