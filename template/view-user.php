<div class="admin-panel">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <nav>
            <ul>
            <?php if (is_admin()): ?>
                <li>
                    <a href="<?= URL_INDEX ?>?module=admin-panel">Dashboard</a>
                </li>
            <?php endif; ?>
            <?php if (is_admin()): ?>
                <li>
                    <a href="<?= URL_INDEX ?>?module=user">Korisnici</a>
                </li>
            <?php endif; ?>
            <?php if (is_admin()): ?>
                <li>
                    <a href="<?= URL_INDEX ?>?module=statistics">Statistika</a>
                </li>
            <?php endif; ?>    
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header>
            <h1 class="admin">Korisnici</h1>
        </header>
        
        <!-- Korisnik Sekcija -->
        <section class="sekcijaKorisnik">
            <!-- Ostavljen prazan prostor za statistiku -->
            <div class="korisnik-content">
                <!-- Dodaj korisnik ovde -->
            </div>
        </section>
    </main>
</div>