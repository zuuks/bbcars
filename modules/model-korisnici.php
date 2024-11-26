<?php
if($_SESSION['login_status'] ?? '' == true && is_admin()){
    $_page_view['view_filename'] = DIR_VIEW . 'view-korisnici.php';
}else{
    redirect(URL_INDEX . '?module=login&action=login');
}

require 'config.php';

$conn = new mysqli(
    $config['hostname'],
    $config['username'],
    $config['password'],
    $config['db_name']
);

if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}

$message = "";
if (isset($_POST['ban_user'])) {
    $user_id = intval($_POST['user_id']);

    $check_sql = "SELECT user_level FROM users WHERE id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $user_id);
    $stmt_check->execute();
    $stmt_check->bind_result($user_level);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($user_level == 1) {
        $message = "Ne možete banovati druge admine.";
    } else {
        $delete_sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $message = "Korisnik uspešno banovan!";
        } else {
            $message = "Došlo je do greške prilikom banovanja korisnika: " . $conn->error;
        }
        $stmt->close();
    }
}

$sql = "SELECT id, username, user_level FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Greška u SQL upitu: " . $conn->error);
}


$usersPerPage = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); 

$start = ($page - 1) * $usersPerPage;

$totalUsersQuery = $db->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = $totalUsersQuery->fetch_assoc()['total'];


$totalPages = ceil($totalUsers / $usersPerPage);

$result = $db->query("SELECT * FROM users LIMIT $start, $usersPerPage");



?>
