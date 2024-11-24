<?php

if ($_POST) {
	$imeprez = $_POST['imeprez'];
	$adresa = $_POST['adresa'];
	$fon = $_POST['fon'];
	$osobe = $_POST['osobe'];
	$auto = $_POST['auto'];
	$napomena = $_POST['prk'];

	if (empty ($imeprez) || empty ($adresa) || empty ($fon) || empty ($osobe) || empty ($auto)) {
		redirect(URL_INDEX);
	} else {
		if (empty ($napomena)) {
			$napomena = "Bez napomena.";
		}
		$sql = "INSERT INTO kontakt (imeprez, adresa, fon, osobe, auto, napomena) VALUES ('$imeprez', '$adresa', '$fon', '$osobe', '$auto', '$napomena')";
		mysqli_query($db, $sql);
		redirect(URL_INDEX);
	}


}

$_page_view['view_filename'] = DIR_VIEW . 'view-contact.php';


function getVozila($db)
{
	$options = '';

	$sql = "SELECT salon_title FROM salon";
	$result = mysqli_query($db, $sql);

	if ($result && mysqli_num_rows($result) > 0) {
		while ($row = $result->fetch_assoc()) {
			$options .= '<option value="' . $row["salon_title"] . '">' . $row["salon_title"] . '</option>';
		}
	} else {
		$options = "Nema rezultata iz baze podataka.";
	}

	return $options;
}
?>