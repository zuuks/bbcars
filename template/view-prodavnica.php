<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="prodavnica">
    <div class="filteri">
        <h1 class="h3Prod">Automobili</h1>
        <table class="filteri">
            <tr>
                <td><?php echo getMarke($db); ?></td>
                <td><?php echo getModel($db); ?></td>
            </tr>
            <tr>
                <td><?php echo getGorivo($db); ?></td>
                <td><?php echo getStanje($db); ?></td>
            </tr>
            <tr>
                <td><input type="text" id="cenaod" placeholder="Cena od €">
                    <input type="text" id="cenado" placeholder="Cena do €">
                </td>
                <td><input type="text" id="kmod" placeholder="KM od">
                    <input type="text" id="kmdo" placeholder="KM do">
                </td>
            </tr>
            <tr>
                <td><input type="text" id="snaga" placeholder="Snaga (kw)"></td>
                <td><button id="filteriProdavnica">Pogledaj</button></td>
            </tr>
        </table>
        <h1 class="h1prod2">Izdvajamo za vas...</h1>
        <div id="rezultati"><?php
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            
            $filteri = [
                'marka' => $_POST['marka'] ?? '',
                'model' => $_POST['model'] ?? '',
                'gorivo' => $_POST['gorivo'] ?? '',
                'stanje' => $_POST['stanje'] ?? '',
                'cena_od' => $_POST['cena_od'] ?? '',
                'cena_do' => $_POST['cena_do'] ?? '',
                'km_od' => $_POST['km_od'] ?? '',
                'km_do' => $_POST['km_do'] ?? '',
                'snaga' => $_POST['snaga'] ?? ''
            ];
        
            echo pretrazi($db, $filteri);
            exit;
        }
        ?>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        // Kada se klikne dugme Pogledaj
        $("#filteriProdavnica").click(function () {
            // Prikupljanje vrednosti sa forme
            var marka = $("select[name='marka']").val();
            var model = $("select[name='model']").val();
            var gorivo = $("select[name='gorivo']").val();
            var stanje = $("select[name='stanje']").val();
            var cenaOd = $("#cenaod").val();
            var cenaDo = $("#cenado").val();
            var kmOd = $("#kmod").val();
            var kmDo = $("#kmdo").val();
            var snaga = $("#snaga").val();

            // Slanje AJAX zahteva na server
            $.ajax({
                url: "", // Prazan URL jer je JS i PHP u istom fajlu
                method: "POST",
                data: {
                    marka: marka,
                    model: model,
                    gorivo: gorivo,
                    stanje: stanje,
                    cena_od: cenaOd,
                    cena_do: cenaDo,
                    km_od: kmOd,
                    km_do: kmDo,
                    snaga: snaga
                },
                success: function (response) {
                    // Prikaz rezultata pretrage
                    $("#rezultati").html(response);
                },
                error: function () {
                    alert("Došlo je do greške prilikom pretrage.");
                }
            });
        });
    });
</script>
