<?php

function salon_image_filename($id, $thumb = false)
{
	$thumb_suffix = $thumb ? '-th' : '';
	return sprintf('salon-%d%s.jpg', $id, $thumb_suffix);
}
function deleteFolder($folderPath) {
    $files = glob($folderPath . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    return rmdir($folderPath);
}

if ($_app['action'] != '') {
	switch ($_app['action']) {
		case 'submit':
			if ($_POST) {
				if (($_POST['cancel'] ?? '') == 1)
					redirect(URL_INDEX);


				$salon_title = $_POST['salon_title'];
				$duzina = $_POST['duzina'];
				$snaga = $_POST['snaga'];
				$potrosnja = $_POST['potrosnja'];
				$cena = $_POST['cena'];
				$recenzija = $_POST['recenzija'];

				$sql = "INSERT INTO `salon` 
								(`salon_title`, `duzina`, `snaga`, `potrosnja`, `cena`,`recenzija`) 
							VALUES
								('{$salon_title}', '{$duzina}', '{$snaga}', '{$potrosnja}','{$cena}','{$recenzija}')";
				mysqli_query($db, $sql);


				if (!isset ($_FILES['images'])) {
					$_page_view['_error'][] = 'Niste odabrali slike za upload.';
				} else {
					$images = $_FILES['images'];
					foreach ($images['tmp_name'] as $key => $tmp_name) {
						$image = $_FILES['image'];
						if ($image['error'][$key] != 0) {
							$_page_view['_error'][] = 'Došlo je do greške. Slika nije učitana';
						} else {

							$salon_id = mysqli_insert_id($db);
							$filename = sprintf('salon-%d_%d.jpg', $salon_id, ($key + 1));


							$folderPath = DIR_PUBLIC_IMAGES . "salon-" . $salon_id;
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
			$_page_view['page_title'] = 'Dodaj automobil';
			$_page_view['view_filename'] = './template/view-salon-submit.php';
			break;
		case 'edit':
			if ($_POST) {
				if (($_POST['cancel'] ?? '') == 1)
					redirect(URL_INDEX);

				$salon_title = $_POST['salon_title'];
				$duzina = $_POST['duzina'];
				$snaga = $_POST['snaga'];
				$potrosnja = $_POST['potrosnja'];
				$cena = $_POST['cena'];
				$recenzija = $_POST['recenzija'];

				$sql = "UPDATE `salon` SET
							`salon_title` = '{$salon_title}',
							`duzina` = '{$duzina}',
							`snaga` = '{$snaga}',
							`potrosnja` = '{$potrosnja}',
							`cena` = '{$cena}',
							`recenzija` = '{$recenzija}'
						WHERE
							`salon_id` = {$_app['id']}
						LIMIT 1";
				mysqli_query($db, $sql);
				redirect(URL_INDEX);
			}
			$sql = "SELECT *
					FROM `salon`
					WHERE `salon_id`={$_app['id']}
					LIMIT 1
				";
			$result = mysqli_query($db, $sql);
			$article = mysqli_fetch_assoc($result);
			$_page_view['page_title'] = 'Izmena članka';
			$_page_view['view_filename'] = './template/view-salon-submit.php';
			break;
		case 'delete':
			if ($_POST) {
				if ($_POST['confirm_action'] == 1) {
					$sql = "DELETE FROM `salon` WHERE `salon_id`={$_app['id']} LIMIT 1";
					mysqli_query($db, $sql);
					$folderPath = DIR_PUBLIC_IMAGES .  "salon-" . $_app['id'];
					deleteFolder($folderPath);
					redirect(URL_INDEX);
				} else if ($_POST['confirm_action'] == 0) {
					redirect(URL_INDEX);
				}
			}

			$sql = "SELECT `salon_title` FROM `salon` WHERE `salon_id`={$_app['id']} LIMIT 1";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);
			$_page_view['admin_confirmation'] = 1;
			$_page_view['page_title'] = $row['salon_title'];
			$_page_view['view_filename'] = '';
			break;
	}
} else {
	if ($_app['id'] > 0) {
		$article = [];
		$sql = "SELECT *
				FROM `salon`
				WHERE `salon_id`={$_app['id']}
				LIMIT 1
			";
		$result = mysqli_query($db, $sql);
		$article = mysqli_fetch_assoc($result);
		$article['salon_image_filename'] = salon_image_filename($article['salon_id']);

		if (empty ($article))
			redirect(URL_INDEX . '?module=error404');

		$_page_view['view_filename'] = './template/view-salon-article.php';
	} else {
		$salon = [];
		$sql = "SELECT * 
				FROM `salon`";
		$result = mysqli_query($db, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$row['salon_thumb_filename'] = salon_image_filename($row['salon_id'], true);
			$salon[] = $row;
		}

		$_page_view['view_filename'] = './template/view-salon-list.php';
	}
}

?>