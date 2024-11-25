<head>
    <script>
        let slideBr = 1;
        prikaziSlide(slideBr);
        function promeniSlide(n) {
            prikaziSlide(slideBr += n);
        }
        function trenutniSlide(n) {
            prikaziSlide(slideBr = n);
        }
        function prikaziSlide(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) { slideBr = 1 }
            if (n < 1) { slideBr = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideBr - 1].style.display = "block";
        }

    </script>
</head>
<main>
    <h1 class="h1auto"><?= $article['marka'] ?>  <?= $article['model'] ?></h1>
    <p class="h2auto"><?= $article['opis'] ?> </p>
    <div class="podacivozila">
        <div class="levoauto">
        <img src="<?= $article['slika'] ?>" alt="">
        </div>
        <div class="desnoauto">
        <table class ="tablaKOLA" style=" background-color: rgb(221, 221, 221); border:none; height:auto;">
            <tr>
                <td class="autoInfo  smanjije">Cena:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['cena'] ?><span class="jedinice">€</span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Vrsta goriva:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['vrsta_goriva'] ?><span class="jedinice"></span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Godiste:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['godiste'] ?><span class="jedinice"></span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Kilometraza:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['predjeni_kilometri'] ?><span class="jedinice">km</span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Kubikaza:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['kubikaza'] ?><span class="jedinice">ccm</span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Snaga:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['snaga_motora'] ?><span class="jedinice">kw</span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Stanje:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['novo_polovno'] ?><span class="jedinice"></span>
                </td>
            </tr>
            <tr>
                <td class="autoInfo smanjije">Poreklo:</td>
                <td class="velikaSlova smanjije">
                    <?= $article['uvoz_domace'] ?><span class="jedinice"></span>
                </td>
            </tr>

        </table>
        </div>
        
    </div>
   
</main>