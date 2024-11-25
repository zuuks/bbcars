<div class="kontakt">
	<div class="mapouter">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1451.395676619086!2d21.895016934086527!3d43.31862700018157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4755b0b16f291241%3A0x5d4587d453cb8630!2z0KPQvdC40LLQtdGA0LfQuNGC0LXRgiDQodC40L3Qs9C40LTRg9C90YPQvA!5e0!3m2!1ssr!2srs!4v1674499742937!5m2!1ssr!2srs"
			width="1920" height="450" style="border:0;" allowfullscreen="" loading="lazy"
			referrerpolicy="no-referrer-when-downgrade" class="kontaktframe"></iframe>
	</div>
	<div class="infoKontakt">
		<h1 class="velikaSlova">BB CARS</h1>
		<h2>Ovlasceni prodavac <strong>AUDI</strong> vozila u <strong>Srbiji</strong></h1>
			<p>Radno vreme: <strong>09:00 - 17:00 H</strong></p>
			<p>Telefon: <strong>+381606551565 / +381692560447</strong></p>
			<p>E-mail: <strong>support@bbcars.rs</strong></p>
			<p>Adresa: <strong>Nikole Pasica 28, 18000 Nis</strong></p>
			<p style="margin-top: 1.5em;">Zakazivanje termina</p>
			<a href="./index.php?module=contact#form"><i class="fa-solid fa-angle-down"></i></a>
	</div>
	<div id="formKontakt">
		<form id="kontaktInfo" method="post">
			<p style="margin-top: -1em;">ZAKAZITE TERMIN</p>
			<div class="formalista">
				<label for="imeprez">Ime i prezime</label> <br>
				<input type="text"  name = "imeprez" class="kontaktInput">
			</div>
			<div class="formalista">
				<label for="adresa">Vasa adresa</label> <br>
				<input type="text"  name = "adresa" class="kontaktInput">
			</div>
			<div class="formalista">
				<label for="fon">Vas telefon</label> <br>
				<input type="text"  name = "fon" class="kontaktInput">
			</div>
			<div class="formalista">
				<label for="osobe">Broj osoba</label> <br>
				<select name="osobe" id="osobe">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div class="formalista">
				<label for="auto">Vozilo</label><br>
				<select name="auto" id="auto">
					<?php echo getVozila($db);?>
				</select>
			</div>
			<label for="prk">Napomena:</label><br>
			<textarea name="prk" id="prk" cols="50" rows="10" placeholder="Ovo polje nije obavezno"></textarea>
			<button class="kontaktSalji">Posalji zahtev</button>
		</form>
	</div>
	<div></div>

	
</div class="kontakt">