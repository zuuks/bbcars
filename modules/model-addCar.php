<?php
// Postavljanje osnovnih parametara stranice
$_page_view['page_title'] = 'Dodaj Novi Automobil';

// Provera korisničkih prava
if ($_SESSION['user_role'] !== USER_ADMIN) {
    $_page_view['_error'][] = 'Nemate prava pristupa ovoj stranici.';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naziv = $_POST['naziv'] ?? '';
    $duzina = (int)$_POST['duzina'] ?? 0;
    $snaga = (int)$_POST['snaga'] ?? 0;
    $potrosnja = (float)$_POST['potrosnja'] ?? 0;
    $cena = (float)$_POST['cena'] ?? 0;

    // Provera validacije
    if (empty($naziv) || $duzina <= 0 || $snaga <= 0 || $potrosnja <= 0 || $cena <= 0) {
        $_page_view['_error'][] = 'Sva polja moraju biti ispravno popunjena.';
    } else {
        // Upit za dodavanje u bazu
        $stmt = $db->prepare('INSERT INTO automobili (naziv, duzina, snaga, potrosnja, cena) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('siiid', $naziv, $duzina, $snaga, $potrosnja, $cena);

        if ($stmt->execute()) {
            $_page_view['_message'][] = 'Automobil je uspešno dodat!';
        } else {
            $_page_view['_error'][] = 'Greška prilikom dodavanja automobila.';
        }
    }
}
