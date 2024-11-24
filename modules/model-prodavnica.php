<?php
if (!$db) {
    die("Greška pri povezivanju sa bazom.");
}

$_page_view['view_filename'] = DIR_VIEW . 'view-prodavnica.php';

function getMarke($db) {
    $sql = "SELECT marka FROM vozila"; 
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

?>


