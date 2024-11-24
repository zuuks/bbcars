<div class="loginPage">
    <?php if (($_SESSION['login_status'] ?? '') == 1): ?>
        <a href="<?= URL_INDEX ?>">Vrati se na početnu stranu</a>
    <?php else: ?>
        <form id="kontaktInfo" method="post">
            <p style="margin-top: -1em;">PRIJAVA</p>
            <div class="formalista">
                <label>Username</label> <br>
                <input type="text" name="user" value="<?= $_POST['user'] ?? '' ?>" class="kontaktInput">
            </div>
            <div class="formalista">
                <label>Password</label> <br>
                <input type="password" name="password" class="kontaktInput">
            </div>
            <button name="login" class="kontaktSalji">Prijava</button>
            <button name="register" class="kontaktSalji" style="margin-left:20px;">Registracija</button>
        </form>
    <?php endif; ?>

</div>