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
                    redirect(URL_INDEX . "?module=admin-panel");

                // Preuzimanje podataka sa forme
                $marka = $_POST['marka'];
                $model = $_POST['model'];
                $vrsta_goriva = $_POST['vrsta_goriva']; // Vrsta goriva
                $godiste = $_POST['godiste']; // Godište
                $predjeni_kilometri = $_POST['predjeni_km']; // Pređeni kilometri
                $kubikaza = $_POST['kubikaza']; // Kubikaža
                $snaga_motora = $_POST['snaga_motora']; // Snaga motora
                $cena = $_POST['cena']; // Cena vozila
                $novo_polovno = $_POST['novi_polovni']; // Novi ili polovni
                $uvoz_domace = $_POST['uvoz_domac']; // Uvozno ili domaće

                // Unos u bazu
                $sql = "INSERT INTO `vozila` 
                            (`cena`, `marka`, `model`, `vrsta_goriva`, `godiste`, `predjeni_kilometri`, `kubikaza`, `snaga_motora`, `novo_polovno`, `uvoz_domace`) 
                        VALUES
                            ('{$cena}', '{$marka}', '{$model}', '{$vrsta_goriva}', '{$godiste}', '{$predjeni_kilometri}', '{$kubikaza}', '{$snaga_motora}', '{$novo_polovno}', '{$uvoz_domace}')";
                mysqli_query($db, $sql);

                // Obrada slika
                if (!isset($_FILES['images'])) {
                    $_page_view['_error'][] = 'Niste odabrali slike za upload.';
                } else {
                    $images = $_FILES['images'];
                    foreach ($images['tmp_name'] as $key => $tmp_name) {
                        $image = $_FILES['images'];
                        if ($image['error'][$key] != 0) {
                            $_page_view['_error'][] = 'Došlo je do greške. Slika nije učitana';
                        } else {

                            // Dobijanje ID-a poslednjeg unetog vozila
                            $vozilo_id = mysqli_insert_id($db);
                            $filename = sprintf('vozilo-%d_%d.jpg', $vozilo_id, ($key + 1));

                            // Kreiranje direktorijuma za slike
                            $folderPath = DIR_PUBLIC_IMAGES . "vozilo-" . $vozilo_id;
                            if (!is_dir($folderPath) && !mkdir($folderPath, 0777, true)) {
                                $_page_view['_error'][] = "Greška: Nije moguće kreirati direktorijum $folderPath";
                            }

                            $destination = $folderPath . DIRECTORY_SEPARATOR . $filename;

                            // Provera dozvola za pisanje
                            if (!is_writable($folderPath)) {
                                $_page_view['_error'][] = "Greška: Nemate dozvolu za pisanje u direktorijum $folderPath";
                            }

                            // Premještanje fajla u direktorijum
                            move_uploaded_file($tmp_name, $destination);
                        }
                    }
                    redirect(URL_INDEX . "?module=admin-panel");
                }
            }
            $_page_view['page_title'] = 'Dodaj vozilo';
            $_page_view['view_filename'] = './template/view-vozilo-submit.php';
            break;
        case 'edit':
            if ($_POST) {
                if (($_POST['cancel'] ?? '') == 1)
                    redirect(URL_INDEX . "?module=admin-panel");

                // Preuzimanje podataka sa forme
                $marka = $_POST['marka'];
                $model = $_POST['model'];
                $vrsta_goriva = $_POST['vrsta_goriva']; // Vrsta goriva
                $godiste = $_POST['godiste']; // Godište
                $predjeni_kilometri = $_POST['predjeni_km']; // Pređeni kilometri
                $kubikaza = $_POST['kubikaza']; // Kubikaža
                $snaga_motora = $_POST['snaga_motora']; // Snaga motora
                $cena = $_POST['cena']; // Cena vozila
                $novo_polovno = $_POST['novi_polovni']; // Novi ili polovni
                $uvoz_domace = $_POST['uvoz_domac']; // Uvozno ili domaće

                // Ažuriranje podataka u bazi
                $sql = "UPDATE `vozila` SET
                            `cena` = '{$cena}',
                            `marka` = '{$marka}',
                            `model` = '{$model}',
                            `vrsta_goriva` = '{$vrsta_goriva}',
                            `godiste` = '{$godiste}', 
                            `predjeni_kilometri` = '{$predjeni_kilometri}',
                            `kubikaza` = '{$kubikaza}', 
                            `snaga_motora` = '{$snaga_motora}', 
                            `novo_polovno` = '{$novo_polovno}', 
                            `uvoz_domace` = '{$uvoz_domace}' 
                        WHERE
                            `id` = {$_app['id']}
                        LIMIT 1";
                mysqli_query($db, $sql);
                redirect(URL_INDEX . "?module=admin-panel");
            }

            // Prikazivanje podataka za uređivanje
            $sql = "SELECT * FROM `vozila` WHERE `id`={$_app['id']}";
            $result = mysqli_query($db, $sql);
            $_page_view['page_title'] = 'Izmeni vozilo';
            $_page_view['view_filename'] = './template/view-vozilo-submit.php';
            break;
            case 'delete':
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                    $vozilo_id = (int)$_GET['id'];
                    if ($vozilo_id > 0) {
                        // Brisanje vozila
                        $sql = "DELETE FROM `vozila` WHERE `id` = $vozilo_id LIMIT 1";
                        if (mysqli_query($db, $sql)) {
                            // Brisanje slike povezane sa vozilom
                            $folderPath = DIR_PUBLIC_IMAGES . "vozilo-" . $vozilo_id;
                            if (is_dir($folderPath)) {
                                array_map('unlink', glob("$folderPath/*.*"));
                                rmdir($folderPath);
                            }
                            redirect(URL_INDEX . "?module=admin-panel&msg=success");
                        } else {
                            redirect(URL_INDEX . "?module=admin-panel&msg=error");
                        }
                    }
                }
                break;
    }
} else {
    if ($_app['id'] > 0) {
        $article = [];
        $sql = "SELECT *
				FROM `vozila`
				WHERE `id`={$_app['id']}
				LIMIT 1
			";
        $result = mysqli_query($db, $sql);
        $article = mysqli_fetch_assoc($result);

        if (empty($article))
            redirect(URL_INDEX . '?module=error404');

        $_page_view['view_filename'] = './template/view-vozilo-article.php';
    }
}
?>