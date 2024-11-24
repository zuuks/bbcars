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

// SQL upit za dobijanje vozila
$sql = "SELECT id, cena, marka, model, godiste, predjeni_kilometri FROM vozila";
$result = $conn->query($sql);
?>

<div class="admin-panel">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Korisnici</a></li>
                <li><a href="#">Statistika</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header>
            <h1 class="admin">Dobrodošli, Admin</h1>
            <?php if (is_admin()): ?>
                <a href="<?= URL_INDEX ?>?module=salon&action=submit" class="navdugme">
                    <button class="btn-primary">Dodaj novi automobil</button>
                </a>
            <?php endif; ?>
        </header>
        
        <!-- Data Table -->
        <section class="sekcijaadmin">
            <h2>Lista Automobila</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Godina</th>
                        <th>Kilometraža</th>
                        <th>Cena (€)</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Prikazivanje podataka u tabeli
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['marka'] . "</td>
                                    <td>" . $row['model'] . "</td>
                                    <td>" . $row['godiste'] . "</td>
                                    <td>" . $row['predjeni_kilometri'] . "</td>
                                    <td>" . $row['cena'] . "</td>
                                    <td>
                                        <button class='btn-edit'>Izmeni</button>
                                        <button class='btn-delete'>Obriši</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Nema podataka</td></tr>";
                    }

                    // Zatvaranje konekcije
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</div>