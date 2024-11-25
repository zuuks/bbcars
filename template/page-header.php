<!DOCTYPE html>
<html>

<head>
	<title>Dobrodošli na Audi Salon</title>
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<link rel="stylesheet" type="text/css" href="public/css/index.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://kit.fontawesome.com/4d1e1be6f0.js" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<nav class="nav-menu">
			<div class="logo">
				<img src="<?= DIR_PUBLIC_IMAGES . 'logo.png' ?>" alt="">
			</div>
			<ul class="ul-nav">
				<li><a href="<?= URL_INDEX ?>" class="navdugme"><i class="fa-solid fa-house"></i>Pocetna</a></li>

				<li><a href="<?= URL_INDEX ?>?module=prodavnica" class="navdugme"><i
								class="fa-solid fa-address-book"></i>Prodavnica</a></li>

				<?php if ($_SESSION['login_status'] ?? '' == true): ?>
					<li><a href="<?= URL_INDEX ?>?module=contact" class="navdugme"><i
								class="fa-solid fa-address-book"></i>Kontakt</a></li>
				<?php else: ?>
					<li><a href="<?= URL_INDEX ?>?module=login&action=login" class="navdugme"><i
								class="fa-solid fa-address-book"></i>Kontakt</a></li>
				<?php endif; ?>


				<?php if ($_SESSION['login_status'] ?? '' == true): ?>
					<?php if (is_admin()): ?>
						<li><a href="<?= URL_INDEX ?>?module=admin-panel" class="navdugme"><i
									class="fa-solid fa-address-book"></i>Admin Panel</a></li>
					<?php endif; ?>

					<li><a href="<?= URL_INDEX ?>?module=login&action=logout" class="navdugme"><i
								class="fa-solid fa-sign-out"></i>Odjava</a></li>
				<?php else: ?>
					<li><a href="<?= URL_INDEX ?>?module=login&action=login" class="navdugme"><i
								class="fa-solid fa-sign-in"></i>Prijava</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</header>