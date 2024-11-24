<?php

function is_admin() {
	return 
		($_SESSION['login_status'] ?? '') == 1 
		&& ($_SESSION['user_level'] ?? '') == USER_ADMIN 
		? true : false;
}

?>