<div class="dodajAuto">
	<article>
		<form id="kontaktInfo" method="post" enctype="multipart/form-data">
			<label>Cena</label>
			<input type="text" name="cena" value="<?= $article['cena'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Marka</label>
			<input type="text" name="marka" value="<?= $article['marka'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Model</label>
			<input type="text" name="model" value="<?= $article['model'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Tip goriva</label>
			<input type="text" name="vrsta_goriva" value="<?= $article['vrsta_goriva'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Godina proizvodnje</label>
			<input type="number" name="godiste" value="<?= $article['godiste'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Predjeni kilometri</label>
			<input type="number" name="predjeni_km" value="<?= $article['predjeni_km'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Kubikaza (cm³)</label>
			<input type="number" name="kubikaza" value="<?= $article['kubikaza'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Snaga motora (kW)</label>
			<input type="number" name="snaga_motora" value="<?= $article['snaga_motora'] ?? '' ?>" class="kontaktInput"><br>
			
			<label>Tip vozila (novi ili polovni)</label>
			<select name="novi_polovni" class="kontaktInput">
				<option value="novo" <?= isset($article['novi_polovni']) && $article['novi_polovni'] == 'novo' ? 'selected' : '' ?>>Novo</option>
				<option value="polovno" <?= isset($article['novi_polovni']) && $article['novi_polovni'] == 'polovno' ? 'selected' : '' ?>>Polovno</option>
			</select><br>
			
			<label>Uvoz ili domaće</label>
			<select name="uvoz_domac" class="kontaktInput">
				<option value="uvoz" <?= isset($article['uvoz_domac']) && $article['uvoz_domac'] == 'uvoz' ? 'selected' : '' ?>>Uvoz</option>
				<option value="domace" <?= isset($article['uvoz_domac']) && $article['uvoz_domac'] == 'domace' ? 'selected' : '' ?>>Domaće</option>
			</select><br>
			<label for="opis">Opis vozila:</label>
        	<textarea name="opis" id="opis" cols="50" rows="10" required></textarea><br>
			<label>Slike za upload</label>
			
			<input type="file" name="images[]" multiple><br>
			
			<div>
				<button class="kontaktSalji">Pošaljite</button>
				<button type="reset" class="kontaktSalji">Resetuj</button>
				<button name="cancel" value="1" class="kontaktSalji">Otkaži</button>
			</div>
		</form>
	</article>
</div>
