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

                $marka = $_POST['marka'];
                $model = $_POST['model'];
                $vrsta_goriva = $_POST['vrsta_goriva'];
                $godiste = $_POST['godiste'];
                $predjeni_kilometri = $_POST['predjeni_km'];
                $kubikaza = $_POST['kubikaza'];
                $snaga_motora = $_POST['snaga_motora'];
                $cena = $_POST['cena'];
                $novo_polovno = $_POST['novi_polovni'];
                $uvoz_domace = $_POST['uvoz_domac'];
                $opis = $_POST['opis'];


                $sql = "INSERT INTO `vozila` 
                            (`cena`, `marka`, `model`, `vrsta_goriva`, `godiste`, `predjeni_kilometri`, `kubikaza`, `snaga_motora`, `novo_polovno`, `uvoz_domace`, `opis`) 
                        VALUES
                            ('{$cena}', '{$marka}', '{$model}', '{$vrsta_goriva}', '{$godiste}', '{$predjeni_kilometri}', '{$kubikaza}', '{$snaga_motora}', '{$novo_polovno}', '{$uvoz_domace}', '{$opis}')";
                mysqli_query($db, $sql);

                if (!isset($_FILES['images'])) {
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
                                $_page_view['_error'][] = "Greška: Nije moguće kreirati direktorijum $folderPath";
                            }

                            $destination = $folderPath . DIRECTORY_SEPARATOR . $filename;

                            if (!is_writable($folderPath)) {
                                $_page_view['_error'][] = "Greška: Nemate dozvolu za pisanje u direktorijum $folderPath";
                            }


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


                $marka = $_POST['marka'];
                $model = $_POST['model'];
                $vrsta_goriva = $_POST['vrsta_goriva'];
                $godiste = $_POST['godiste'];
                $predjeni_kilometri = $_POST['predjeni_km'];
                $kubikaza = $_POST['kubikaza'];
                $snaga_motora = $_POST['snaga_motora'];
                $cena = $_POST['cena'];
                $novo_polovno = $_POST['novi_polovni'];
                $uvoz_domace = $_POST['uvoz_domac'];


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


            $sql = "SELECT * FROM `vozila` WHERE `id`={$_app['id']}";
            $result = mysqli_query($db, $sql);
            $_page_view['page_title'] = 'Izmeni vozilo';
            $_page_view['view_filename'] = './template/view-vozilo-submit.php';
            break;
        case 'delete':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                $vozilo_id = (int)$_GET['id'];
                if ($vozilo_id > 0) {

                    $sql = "DELETE FROM `vozila` WHERE `id` = $vozilo_id LIMIT 1";
                    if (mysqli_query($db, $sql)) {

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
        case 'prodaj':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                $vozilo_id = (int)$_GET['id'];
                if ($vozilo_id > 0) {

                    $sql = "UPDATE vozila SET prodato_vozilo = 1, datum_prodaje = NOW()  WHERE id =$vozilo_id LIMIT 1";
                    if (mysqli_query($db, $sql)) {

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
