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
                <td class="shoptd"><input type="text" id="cenaod" placeholder="Cena od €">
                    <input type="text" id="cenado" placeholder="Cena do €">
                </td>
                <td class="shoptd"><input type="text" id="kmod" placeholder="KM od">
                    <input type="text" id="kmdo" placeholder="KM do">
                </td>
            </tr>
            <tr class="shoptr">
                <td class="shoptd"><input type="text" id="snaga" placeholder="Snaga (kw)"></td>
                <td class="shoptd"><button id="filteriProdavnica">Pogledaj</button></td>
            </tr>
        </table>
        <h1 class="h1prod2">Izdvajamo za vas...</h1>
        <div id="rezultati">
        </div>
        <div id="pagination"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let currentPage = 1;  // Početna stranica

        // Funkcija za učitavanje rezultata sa paginacijom
        function loadCars(page) {
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
                    filters: filters, 
                    page: page  // Prosleđivanje broja stranice
                },
                success: function (response) {
                    $('#rezultati').html(response);
                    currentPage = page;  // Ažuriranje trenutne stranice
                    updatePagination();  // Ažuriraj dugmadi za paginaciju
                },
                error: function () {
                    $('#rezultati').html('<p>Došlo je do greške prilikom filtriranja.</p>');
                }
            });
        }

        // Klik na dugme za sledeću stranu
        $(document).on('click', '.next-page', function () {
            loadCars(currentPage + 1);
        });

        // Klik na dugme za prethodnu stranu
        $(document).on('click', '.prev-page', function () {
            loadCars(currentPage - 1);
        });

        // Funkcija koja ažurira dugmadi za paginaciju
        function updatePagination() {
            $.ajax({
                url: "",
                method: 'POST',
                data: { 
                    action: 'getTotalPages', 
                    filters: filters 
                },
                success: function (response) {
                    const totalPages = parseInt(response);
                    let paginationHtml = '';
                    
                    if (currentPage > 1) {
                        paginationHtml += '<button class="prev-page">Prethodna</button>';
                    }

                    if (currentPage < totalPages) {
                        paginationHtml += '<button class="next-page">Sledeća</button>';
                    }

                    $('#pagination').html(paginationHtml);
                }
            });
        }

        // Pozovi funkciju za učitavanje na početku
        loadCars(currentPage);

        // Kada se klikne na dugme "Pogledaj", učitaj automobile sa filtrima
        $('#filteriProdavnica').on('click', function () {
            loadCars(1);
        });
    });
</script>
