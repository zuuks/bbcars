<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="prodavnica">
    <div class="filteri">
        <h1 class="h3Prod">Automobili</h1>
        <table class="filteri">
            <tr class="shoptr">
                <td class="shoptd"><?php echo getMarke($db); ?></td>
                <td class="shoptd"><?php echo getModel($db); ?></td>
            </tr>
            <tr class="shoptr">
                <td class="shoptd"><?php echo getGorivo($db); ?></td>
                <td class="shoptd"><?php echo getStanje($db); ?></td>
            </tr>
            <tr class="shoptr">
                <td class="shoptd"><input type="text" id="cenaod" placeholder="Cena od €" class="inputshop">
                    <input type="text" id="cenado" placeholder="Cena do €" class="inputshop">
                </td>
                <td class="shoptd"><input type="text" id="kmod" placeholder="KM od" class="inputshop">
                    <input type="text" id="kmdo" placeholder="KM do" class="inputshop">
                </td>
            </tr>
            <tr class="shoptr">
                <td class="shoptd"><input type="text" id="snaga" placeholder="Snaga (kw)" class="inputshop"></td>
                <td class="shoptd"><button id="filteriProdavnica">Pogledaj</button></td>
            </tr>
        </table>
        <h1 class="h1prod2">Izdvajamo za vas...</h1>
        <div id="rezultati">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function loadCars() {
            const filters = {
                marka: $('select[name="marka"]').val(),
                model: $('select[name="model"]').val(),
                gorivo: $('select[name="gorivo"]').val(),
                stanje: $('select[name="stanje"]').val(),
                cenaod: $('#cenaod').val(),
                cenado: $('#cenado').val(),
                kmod: $('#kmod').val(),
                kmdo: $('#kmdo').val(),
                snaga: $('#snaga').val()
            };

            $.ajax({
                url: "",
                method: 'POST',
                data: {
                    action: 'filter',
                    filters: filters
                },
                success: function(response) {
                    $('#rezultati').html(response);
                },
                error: function() {
                    $('#rezultati').html('<p>Došlo je do greške prilikom filtriranja.</p>');
                }
            });
        }

        loadCars();

        $('select[name="marka"]').on('change', function() {
            const selectedMarka = $(this).val();

            $.ajax({
                url: "",
                method: 'POST',
                data: {
                    action: 'getModels',
                    marka: selectedMarka
                },
                success: function(response) {
                    $('select[name="model"]').html(response);
                },
                error: function() {
                    $('select[name="model"]').html('<option value="">Greška pri učitavanju modela</option>');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#filteriProdavnica').on('click', function() {
            const filters = {
                marka: $('select[name="marka"]').val(),
                model: $('select[name="model"]').val(),
                gorivo: $('select[name="gorivo"]').val(),
                stanje: $('select[name="stanje"]').val(),
                cenaod: $('#cenaod').val(),
                cenado: $('#cenado').val(),
                kmod: $('#kmod').val(),
                kmdo: $('#kmdo').val(),
                snaga: $('#snaga').val()
            };

            $.ajax({
                url: "",
                method: 'POST',
                data: {
                    action: 'filter',
                    filters: filters
                },
                success: function(response) {
                    $('#rezultati').html(response);
                },
                error: function() {
                    $('#rezultati').html('<p>Došlo je do greške prilikom filtriranja.</p>');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('select[name="marka"]').on('change', function() {
            const selectedMarka = $(this).val();

            $.ajax({
                url: "",
                method: 'POST',
                data: {
                    action: 'getModels',
                    marka: selectedMarka
                },
                success: function(response) {
                    $('select[name="model"]').html(response);
                },
                error: function() {
                    $('select[name="model"]').html('<option value="">Greška pri učitavanju modela</option>');
                }
            });
        });
    });
</script>