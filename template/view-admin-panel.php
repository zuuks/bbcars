<link rel="stylesheet" href="./public/css/index.css">

<div class="admin-panel">
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
                        <a href="<?= URL_INDEX ?>?module=statistics">Statistika</a>
                    </li>
                <?php endif; ?>
                <?php if (is_admin()): ?>
                    <li>
                        <a href="<?= URL_INDEX ?>?module=korisnici">Korisnici</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </aside>

    <main class="content">
        <header class="admin-header">
            <h1 class="admin">Dobrodošao, Admin</h1>
            <?php if (is_admin()): ?>
                <div class="buttons-container">
                    <a href="<?= URL_INDEX ?>?module=salon&action=submit" class="navdugme">
                        <button class="btn-primary">Dodaj novi automobil</button>
                    </a>

                    <a href="<?= URL_INDEX ?>?module=admin-panel&action=export" class="navdugme">
                        <button class="btn-export">Export to JSON</button>
                    </a>
                </div>
            <?php endif; ?>
        </header>


        <section class="sekcijaadmin">
            <h2 class="admin2">Lista Automobila</h2>


            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="<?= URL_INDEX ?>?module=admin-panel&page=<?= $page - 1 ?>"
                        class="pagination-prev">Prethodna</a>
                <?php endif; ?>

                <span>Stranica <?= $page ?> od <?= $total_pages ?></span>

                <?php if ($page < $total_pages): ?>
                    <a href="<?= URL_INDEX ?>?module=admin-panel&page=<?= $page + 1 ?>" class="pagination-next">Sledeća</a>
                <?php endif; ?>
            </div>


            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Godina</th>
                        <th>Kilometraža</th>
                        <th>Vrsta goiva</th>
                        <th>Zapremina motora</th>
                        <th>Snaga motora</th>
                        <th>Poreklo vozila</th>
                        <th>Stanje vozila</th>
                        <th>Cena (€)</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo
                            "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['marka'] . "</td>
                    <td>" . $row['model'] . "</td>
                    <td>" . $row['godiste'] . "</td>
                    <td>" . $row['predjeni_kilometri'] . "</td>
                    <td>" . $row['vrsta_goriva'] . "</td>
                    <td>" . $row['kubikaza'] . "</td>
                    <td>" . $row['snaga_motora'] . "</td>
                    <td>" . $row['novo_polovno'] . "</td>
                    <td>" . $row['uvoz_domace'] . "</td>
                    <td>" . $row['cena'] . "</td>
                    <td>";

                            if ($row['prodato_vozilo'] == 1) {
                                echo "<span class='status-prodato'>PRODATO</span>";
                            } else {
                                echo "
                    <a href='" . URL_INDEX . "?module=salon&action=prodaj&id=" . $row['id'] . "' class='navdugme' onclick='return confirm(\"Da li ste sigurni da želite da označite vozilo kao prodano?\")'>
                        <button class='btn-prodaj'>Prodaj</button>
                    </a>";
                            }

                            echo "
                <a href='" . URL_INDEX . "?module=salon&action=edit&id=" . $row['id'] . "' class='navdugme' onclick='return confirm(\"Da li ste sigurni da želite da izmenite ovo vozilo?\")'>
                    <button class='btn-edit'>Izmeni</button>
                </a>
                <a href='" . URL_INDEX . "?module=salon&action=delete&id=" . $row['id'] . "' class='navdugme' onclick='return confirm(\"Da li ste sigurni da želite da obrišete ovo vozilo?\")'>
                    <button class='btn-delete'>Obriši</button>
                </a>
            </td>
        </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>Nema podataka</td></tr>";
                    }
                    ?>
                </tbody>

            </table>
        </section>
    </main>
</div>
