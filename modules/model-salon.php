<?php

function vozilo_image_filename($id, $thumb = false)
{
	$thumb_suffix = $thumb ? '-th' : '';
	return sprintf('vozilo-%d%s.jpg', $id, $thumb_suffix);
}

if ($_app['action'] != '') {
	switch ($_app['action']) {
		case 'submit':
			if ($_POST) {
				if (($_POST['cancel'] ?? '') == 1)
					redirect(URL_INDEX);

				// Preuzimanje podataka sa forme
				$marka = $_POST['marka'];
				$model = $_POST['model'];
				$tip_goriva = $_POST['tip_goriva'];
				$godiste = $_POST['godiste'];
				$predjeni_km = $_POST['predjeni_km'];
				$snaga_kw = $_POST['snaga_kw'];
				$cena = $_POST['cena'];
				$novi_polovni = $_POST['novi_polovni'];
				$uvoz_domac = $_POST['uvoz_domac'];
				$recenzija = $_POST['recenzija'];

				$sql = "INSERT INTO `vozila` 
								(`marka`, `model`, `tip_goriva`, `godiste`, `predjeni_km`, `snaga_kw`, `cena`, `novi_polovni`, `uvoz_domac`, `recenzija`) 
							VALUES
								('{$marka}', '{$model}', '{$tip_goriva}', '{$godiste}', '{$predjeni_km}', '{$snaga_kw}', '{$cena}', '{$novi_polovni}', '{$uvoz_domac}', '{$recenzija}')";
				mysqli_query($db, $sql);

				if (!isset ($_FILES['images'])) {
					$_page_view['_error'][] = 'Niste odabrali slike za upload.';
				} else {
					$images = $_FILES['images'];
					foreach ($images['tmp_name'] as $key => $tmp_name) {
						$image = $_FILES['images'];
						if ($image['error'][$key] != 0) {
							$_page_view['_error'][] = 'Došlo je do greške. Slika nije učitana';
						} else {

							$vozilo_id = mysqli_insert_id($db);
							$filename = sprintf('vozilo-%d_%d.jpg', $vozilo_id, ($key + 1));

							$folderPath = DIR_PUBLIC_IMAGES . "vozilo-" . $vozilo_id;
							if (!is_dir($folderPath) && !mkdir($folderPath, 0777, true)) {
								$_page_view['_error'][] ="Greška: Nije moguće kreirati direktorijum $folderPath";
							}

							$destination = $folderPath . DIRECTORY_SEPARATOR . $filename;

							if (!is_writable($folderPath)) {
								$_page_view['_error'][] ="Greška: Nemate dozvolu za pisanje u direktorijum $folderPath";
							}

							move_uploaded_file($tmp_name, $destination);
						}
					}
					redirect(URL_INDEX);
				}
			}
			$_page_view['page_title'] = 'Dodaj vozilo';
			$_page_view['view_filename'] = './template/view-vozilo-submit.php';
			break;
		case 'edit':
			if ($_POST) {
				if (($_POST['cancel'] ?? '') == 1)
					redirect(URL_INDEX);

				// Preuzimanje podataka sa forme
				$marka = $_POST['marka'];
				$model = $_POST['model'];
				$tip_goriva = $_POST['tip_goriva'];
				$godiste = $_POST['godiste'];
				$predjeni_km = $_POST['predjeni_km'];
				$snaga_kw = $_POST['snaga_kw'];
				$cena = $_POST['cena'];
				$novi_polovni = $_POST['novi_polovni'];
				$uvoz_domac = $_POST['uvoz_domac'];
				$recenzija = $_POST['recenzija'];

				$sql = "UPDATE `vozila` SET
							`marka` = '{$marka}',
							`model` = '{$model}',
							`tip_goriva` = '{$tip_goriva}',
							`godiste` = '{$godiste}',
							`predjeni_km` = '{$predjeni_km}',
							`snaga_kw` = '{$snaga_kw}',
							`cena` = '{$cena}',
							`novi_polovni` = '{$novi_polovni}',
							`uvoz_domac` = '{$uvoz_domac}',
							`recenzija` = '{$recenzija}'
						WHERE
							`vozilo_id` = {$_app['id']}
						LIMIT 1";
				mysqli_query($db, $sql);
				redirect(URL_INDEX);
			}
			$sql = "SELECT *
					FROM `vozila`
					WHERE `vozilo_id`={$_app['id']}
					LIMIT 1
				";
			$result = mysqli_query($db, $sql);
			$article = mysqli_fetch_assoc($result);
			$_page_view['page_title'] = 'Izmena vozila';
			$_page_view['view_filename'] = './template/view-vozilo-submit.php';
			break;
		case 'delete':
			if ($_POST) {
				if ($_POST['confirm_action'] == 1) {
					$sql = "DELETE FROM `vozila` WHERE `vozilo_id`={$_app['id']} LIMIT 1";
					mysqli_query($db, $sql);

					redirect(URL_INDEX);
				} else if ($_POST['confirm_action'] == 0) {
					redirect(URL_INDEX);
				}
			}

			$sql = "SELECT `marka`, `model` FROM `vozila` WHERE `vozilo_id`={$_app['id']} LIMIT 1";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);
			$_page_view['admin_confirmation'] = 1;
			$_page_view['page_title'] = $row['marka'] . ' ' . $row['model'];
			$_page_view['view_filename'] = '';
			break;
	}
} else {
	if ($_app['id'] > 0) {
		$article = [];
		$sql = "SELECT *
				FROM `vozila`
				WHERE `vozilo_id`={$_app['id']}
				LIMIT 1
			";
		$result = mysqli_query($db, $sql);
		$article = mysqli_fetch_assoc($result);
		$article['vozilo_image_filename'] = vozilo_image_filename($article['vozilo_id']);

		if (empty ($article))
			redirect(URL_INDEX . '?module=error404');

		$_page_view['view_filename'] = './template/view-vozilo-article.php';
	} else {
		$vozila = [];
		$sql = "SELECT * 
				FROM `vozila`";
		$result = mysqli_query($db, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$row['vozilo_thumb_filename'] = vozilo_image_filename($row['vozilo_id'], true);
			$vozila[] = $row;
		}

		$_page_view['view_filename'] = './template/view-vozilo-list.php';
	}
}


?>