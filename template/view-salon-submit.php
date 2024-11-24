<div class="dodajAuto">
	<article>
		<form id="kontaktInfo" method="post" enctype="multipart/form-data">
			<label>Ime modela</label>
			<input type="text" name="salon_title" value="<?= $article['salon_title'] ?? '' ?>" class="kontaktInput"> <br>
			<label>Duzina Vozila</label>
			<input type="text" name="duzina" value="<?= $article['duzina'] ?? '' ?>" class="kontaktInput"><br>
			<label>Snaga</label>
			<input type="text" name="snaga" value="<?= $article['snaga'] ?? '' ?>" class="kontaktInput"><br>
			<label>Potrosnja</label>
			<input type="text" name="potrosnja" value="<?= $article['potrosnja'] ?? '' ?>" class="kontaktInput"><br>
			<label>Cena</label>
			<input type="text" name="cena" value="<?= $article['cena'] ?? '' ?>" class="kontaktInput"><br>
			<label>Ugradjeni kod za video recenziju (iframe)</label>
			<input class="kontaktInput" type="text" name="recenzija" value="<?= htmlspecialchars($article['recenzija'] ?? '') ?>"><br>
			<label>Slike za upload</label>
			<input type="file" name="images[]" multiple ><br>
			<div>
				<button class="kontaktSalji">Pošalji</button>
				<button type="reset" class="kontaktSalji">Resetuj</button>
				<button name="cancel" value="1" class="kontaktSalji">Otkaži</button>
			</div>
		</form>
	</article>
</div>