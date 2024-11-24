<h1>Dodaj Novi Automobil</h1>

<?php if (!empty($_page_view['_error'])): ?>
    <div class="error">
        <?php foreach ($_page_view['_error'] as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($_page_view['_message'])): ?>
    <div class="message">
        <?php foreach ($_page_view['_message'] as $message): ?>
            <p><?= $message ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST">
    <label for="naziv">Naziv automobila:</label>
    <input type="text" name="naziv" id="naziv" required>

    <label for="duzina">Dužina (mm):</label>
    <input type="number" name="duzina" id="duzina" required>

    <label for="snaga">Snaga (kW):</label>
    <input type="number" name="snaga" id="snaga" required>

    <label for="potrosnja">Potrošnja (L/100km):</label>
    <input type="number" step="0.1" name="potrosnja" id="potrosnja" required>

    <label for="cena">Cena (€):</label>
    <input type="number" step="0.01" name="cena" id="cena" required>

    <button type="submit">Dodaj Automobil</button>
</form>
