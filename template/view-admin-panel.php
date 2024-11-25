<style>

.pagination {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 15px;
    position: relative;
    top: -4px;  /* Pomera paginaciju ka gore */
    font-family: Arial, sans-serif;
}


.pagination span {
    font-size: 18px;  /* Povecaj font za broj stranice */
    font-weight: bold;
    color: #888;  /* Svetlija boja za broj stranice */
}

.pagination a {
    padding: 10px 20px;
    text-decoration: none;
    color: white;
    background-color: rgb(37, 118, 136);
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: rgb(40, 150, 150);
}

.pagination-prev,
.pagination-next {
    font-weight: bold;
}

.pagination-prev:disabled,
.pagination-next:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}


</style>

<?php
// Povezivanje sa bazom podataka
$servername = "localhost";
$username = "root"; // Prilagodite korisničko ime
$password = ""; // Prilagodite lozinku
$dbname = "bbcars";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proverite da li je zahtev za izvoz
if (isset($_GET['action']) && $_GET['action'] == 'export') {
    // SQL upit za dobijanje svih automobila
    $sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri FROM vozila";
    $result = $conn->query($sql);

    // Kreiranje niza za skladištenje podataka o vozilima
    $vehicles = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }

        // Generisanje JSON-a
        $json_data = json_encode($vehicles, JSON_PRETTY_PRINT);

        // Postavljanje odgovarajućih zaglavlja za preuzimanje JSON fajla
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="vozila.json"');
        
        // Slanje JSON podataka za preuzimanje
        echo $json_data;

        exit; // Završava izvršavanje skripte nakon slanja fajla
    } else {
        echo "Nema podataka za eksportovanje."; // Ispis greške ako nema podataka
    }
}


// Definisanje broja stavki po stranici i trenutne stranice
$items_per_page = 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $items_per_page;

// SQL upit za dobijanje vozila sa paginacijom
$sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri, vrsta_goriva, kubikaza, snaga_motora, novo_polovno, uvoz_domace FROM vozila LIMIT $start_from, $items_per_page";
$result = $conn->query($sql);

// Dobijanje ukupnog broja vozila
$total_sql = "SELECT COUNT(*) AS total FROM vozila";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);
?>

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

    <!-- Main Content -->
    <main class="content">
    <header class="admin-header">
        <h1 class="admin">Dobrodošao, Admin</h1>
            <?php if (is_admin()): ?>
                <div class="buttons-container">
                    <a href="<?= URL_INDEX ?>?module=salon&action=submit" class="navdugme">
                        <button class="btn-primary">Dodaj novi automobil</button>
                    </a>
                    <!-- Dugme za export -->
                    <a href="<?= URL_INDEX ?>?module=admin-panel&action=export" class="navdugme">
                        <button class="btn-export">Export to JSON</button>
                    </a>
                </div>
            <?php endif; ?>
    </header>
        
        <!-- Data Table -->
        <section class="sekcijaadmin">
            <h2 class="admin2">Lista Automobila</h2>

            <!-- Paginacija -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="<?= URL_INDEX ?>?module=admin-panel&page=<?= $page - 1 ?>" class="pagination-prev">Prethodna</a>
                <?php endif; ?>
                
                <span>Stranica <?= $page ?> od <?= $total_pages ?></span>

                <?php if ($page < $total_pages): ?>
                    <a href="<?= URL_INDEX ?>?module=admin-panel&page=<?= $page + 1 ?>" class="pagination-next">Sledeća</a>
                <?php endif; ?>
            </div>

            <!-- Tabela sa podacima -->
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
                        // Prikazivanje podataka u tabeli
                        while($row = $result->fetch_assoc()) {
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
                                    <td>
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
                        echo "<tr><td colspan='7'>Nema podataka</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</div>

<?php
// Zatvaranje konekcije
$conn->close();
?>
