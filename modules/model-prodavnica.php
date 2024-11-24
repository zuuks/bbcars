<?php
if (!$db) {
    die("Greška pri povezivanju sa bazom.");
}
$markaDropdown = '<select name="marka">';
$sql = "SELECT DISTINCT marka FROM vozila";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $marka = htmlspecialchars($row['marka']); 
        $markaDropdown .= "<option value=\"$marka\">$marka</option>";
    }
    $markaDropdown .= '</select>';
} else {
    $markaDropdown = '<p>Trenutno nema dostupnih marki.</p>';
}
?>
<div class="prodavnica">
    <div class="filteri">
        <h1 class="h3Prod">Automobili</h1>
        <?php 
        echo $markaDropdown;
        ?>
        <span></span>
    </div>
</div>
