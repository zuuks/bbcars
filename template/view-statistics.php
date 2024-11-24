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
            <li><a href="#">Korisnici</a></li>
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
            <h1 class="admin">Statistika</h1>
        </header>
        
        <!-- Statistika Sekcija -->
        <section class="sekcijastatistika">
            <!-- Ostavljen prazan prostor za statistiku -->
            <div class="statistika-content">
                <!-- Dodaj statistiku ovde -->
            </div>
        </section>
    </main>
</div>