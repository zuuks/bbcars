<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbcars"; // Zameni sa stvarnim imenom tvoje baze 
// Kreiraj vezu sa bazom 
$db = new mysqli($servername, $username, $password, $dbname); // Proveri vezu 
if ($db->connect_error) {
    die("Povezivanje sa bazom nije uspelo: " . $db->connect_error);
}
$_page_view['view_filename'] = './template/view-statistics.php';
// Ispravi SQL upit 
function izvuciMarka($db)
{
    $sql = "SELECT marka, COUNT(*) as broj_vozila 
            FROM vozila 
            WHERE marka != '' AND marka IS NOT NULL AND prodato_vozilo = 0
            GROUP BY marka;";

    $result = mysqli_query($db, $sql);

    if (!$result) {
        die("Greška pri izvršavanju upita: " . mysqli_error($db));
    }

    $dataMarka = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dataMarka[] = $row;
        }
    }

    // Upit za broj prodatih vozila po godinama
    $sqlProdaja = "SELECT YEAR(datum_prodaje) AS godina, COUNT(*) AS broj_prodatih_vozila 
                   FROM vozila 
                   WHERE prodato_vozilo = 1 
                   GROUP BY YEAR(datum_prodaje) 
                   ORDER BY godina DESC;";

    $resultProdaja = mysqli_query($db, $sqlProdaja);

    if (!$resultProdaja) {
        die("Greška pri izvršavanju upita: " . mysqli_error($db));
    }

    $dataProdaja = [];
    if ($resultProdaja->num_rows > 0) {
        while ($row = $resultProdaja->fetch_assoc()) {
            $dataProdaja[] = $row;
        }
    }

    // Upit za broj prodatih vozila u poslednjih 6 meseci
    $sqlProdaja6 = "SELECT marka, COUNT(*) AS broj_prodatih_vozila_poslednjih_6_meseci FROM vozila WHERE prodato_vozilo = 1 AND datum_prodaje >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY marka;";

    $resultProdaja6 = mysqli_query($db, $sqlProdaja6);

    if (!$resultProdaja6) {
        die("Greška pri izvršavanju upita: " . mysqli_error($db));
    }

    $dataProdaja6 = [];
    if ($resultProdaja6->num_rows > 0) {
        while ($row = $resultProdaja6->fetch_assoc()) {
            $dataProdaja6[] = $row;
        }
    }

    // Vraćanje oba skupa podataka u JSON formatu
    return json_encode([
        'marke' => $dataMarka,
        'prodaja' => $dataProdaja,
        'prodaja6' => $dataProdaja6
    ]);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'vadi') {
    echo izvuciMarka($db);
};
?>