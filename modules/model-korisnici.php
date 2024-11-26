<?php
if($_SESSION['login_status'] ?? '' == true && is_admin()){
    $_page_view['view_filename'] = DIR_VIEW . 'view-korisnici.php';
}else{
    redirect(URL_INDEX . '?module=login&action=login');
}

require 'config.php';


$message = "";
if (isset($_POST['ban_user'])) {
    $user_id = intval($_POST['user_id']);  // Sanitizacija korisničkog unosa

    // Prvo proveravamo korisnički nivo
    $check_sql = "SELECT user_level FROM users WHERE id = $user_id";
    $result_check = mysqli_query($db, $check_sql);

    if ($result_check) {
        $row = mysqli_fetch_assoc($result_check);
        $user_level = $row['user_level'];

        // Ako je korisnik admin (user_level == 1), ne možemo ga banovati
        if ($user_level == 1) {
            $message = "Ne možete banovati druge admine.";
        } else {
            // Ako korisnik nije admin, brišemo ga iz baze
            $delete_sql = "DELETE FROM users WHERE id = $user_id";
            if (mysqli_query($db, $delete_sql)) {
                $message = "Korisnik uspešno banovan!";
            } else {
                $message = "Došlo je do greške prilikom banovanja korisnika: " . mysqli_error($db);
            }
        }
    } else {
        $message = "Došlo je do greške prilikom upita: " . mysqli_error($db);
    }
}

$sql = "SELECT id, username, user_level FROM users";
$result = mysqli_query($db, $sql);

if (!$result) {
    die("Greška u SQL upitu: " . $db->error);
}


$usersPerPage = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); 

$start = ($page - 1) * $usersPerPage;

$totalUsersQuery =  mysqli_query($db, "SELECT COUNT(*) AS total FROM users");
$totalUsers = $totalUsersQuery->fetch_assoc()['total'];


$totalPages = ceil($totalUsers / $usersPerPage);

$result =  mysqli_query($db, "SELECT * FROM users LIMIT $start, $usersPerPage");



?>
