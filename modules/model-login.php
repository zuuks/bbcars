<?php

if (($_GET['action'] ?? '') == 'logout') {
    unset($_SESSION['login_status']);
    unset($_SESSION['user_level']);
    redirect(URL_INDEX);
}

if (($_SESSION['login_status'] ?? '') == 1) {
    $_page_view['_message'][] = 'Već ste ulogovani';
} else {
    if ($_POST) {
        if (isset($_POST['login'])) {
            $username = $_POST['user'];
            $password = $_POST['password'];

            if ($username == '' && $password == '') {
                $_page_view['_message'][] = 'Unesite korisničko ime i lozinku';
            } else {
                $sql = "SELECT * FROM `users` WHERE `username`='{$username}'";
                $result = mysqli_query($db, $sql);
                if ($result !== false && $result->num_rows == 1) {
                    $row = mysqli_fetch_assoc($result);

                    if ($row['password'] == md5($password)) {
                        $_SESSION['login_status'] = 1;
                        $_SESSION['user_level'] = $row['user_level'];
                        $_SESSION['username'] = $row['username'];
                        redirect(URL_INDEX);
                    }
                } else {
                    $_page_view['_error'][] = 'Uneti podaci nisu ispravni';
                }
            }
        }
        else if (isset($_POST['register'])) {
            $username = $_POST['user'];
            $password = $_POST['password'];

            if ($username == '' && $password == '') {
                $_page_view['_message'][] = 'Unesite korisničko ime i lozinku';
            } else {
                $sql_check_username = "SELECT * FROM `users` WHERE `username`='{$username}'";
                $result_check_username = mysqli_query($db, $sql_check_username);
                if ($result_check_username !== false && $result_check_username->num_rows > 0) {
                    $_page_view['_error'][] = 'Korisničko ime već postoji';
                } else {
                    $hashed_password = md5($password);
                    $sql_insert_user = "INSERT INTO `users` (`username`, `password`, `user_level`) VALUES ('{$username}', '{$hashed_password}', 0)";
                    $result_insert_user = mysqli_query($db, $sql_insert_user);
                    if ($result_insert_user) {
                        $_SESSION['login_status'] = 1;
                        $_SESSION['user_level'] = 0;
                        $_SESSION['username'] = $username;
                        redirect(URL_INDEX);
                    } else {
                        $_page_view['_error'][] = 'Greška prilikom registracije';
                    }
                }
            }
        }
    }
}

$_page_view['view_filename'] = './template/view-login.php';

?>