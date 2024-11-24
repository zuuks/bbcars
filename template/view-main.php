<main>
    <div class="glavni">
        <div class="levo">
            <div class="text">
                <p><i>NOVI</i></p>
                <p id="red2"><i><b>AUDI A3 SPORTBACK</b></i></p>
                <p><i>NAJNOVIJE GENERACIJE</i></p>
            </div>
            <div class="dugmad">
                <a href="<?= URL_INDEX ?>?module=prodavnica" class="dugmePonuda">POGLEDAJ PONUDU</a>
                <?php if ($_SESSION['login_status'] ?? '' == true): ?>
					<a href="<?= URL_INDEX ?>?module=contact" class="dugmePonuda" id="termin">ZAKAZITE TERMIN</a>
				<?php else: ?>
					<a href="<?= URL_INDEX ?>?module=login&action=login" class="dugmePonuda" id="termin">ZAKAZITE TERMIN</a>
				<?php endif; ?>
                

            </div>
        </div>
        <div class="desno">
        </div>
    </div>
</main>