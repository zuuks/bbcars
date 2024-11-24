<?php
$salonDropdown = '';
$sql = "SELECT `salon_id`, `salon_title` FROM `salon`";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $salon_id = $row['salon_id'];
        $salon_title = $row['salon_title'];
        $url = URL_INDEX . '?module=salon&id=' . $salon_id;
        $salonDropdown .= "<a href=\"$url\" onclick = 'boje()'>$salon_title</a>";
    }
} else {
    $salonDropdown = 'Trenutno nema vozila u prodaji';
}
?>

<div class="dropdown">
    <a href="#" class="navdugme"><i class="fa-solid fa-bag-shopping"></i>Prodavnica</a>
    <div class="dropdown-content">
        <?php echo $salonDropdown; ?>
    </div>
</div>
