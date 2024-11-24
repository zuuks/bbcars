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
    <div class="ime">
        <h1>
            <?= $article['salon_title'] ?>
        </h1>
    </div>
    <div class="slideshow-container">
        <?php
        $folderPath = DIR_PUBLIC_IMAGES . 'salon-' . $article['salon_id'] . DIRECTORY_SEPARATOR;

        if (is_dir($folderPath)) {
            $files = glob($folderPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

            foreach ($files as $file) {
                ?>
                <div class="mySlides fade">
                    <img src="<?= $file ?>">
                </div>
                <?php
            }

        }
        ?>
        <a class="prev" onclick="promeniSlide(-1)">&#10094;</a>
        <a class="next" onclick="promeniSlide(1)">&#10095;</a>
    </div>
    <div class="info">
        <table>
            <tr>
                <td>Dužina</td>
                <td>Snaga</td>
                <td>Potrosnja</td>
                <td>Cena</td>
            </tr>
            <tr>
                <td class="velikaSlova">
                    <?= $article['duzina'] ?><span class="jedinice">mm</span>
                </td>
                <td class="velikaSlova">
                    <?= $article['snaga'] ?><span class="jedinice">kw*</span>
                </td>
                <td class="velikaSlova">
                    <?= $article['potrosnja'] ?>l/100<span class="jedinice">km</span>
                </td>
                <td class="velikaSlova">
                    <?= $article['cena'] ?>€
                </td>
            </tr>
            <tr>
                <td></td>
                <td>(~
                    <?= round($article['snaga'] * 1.34102) ?> KS)
                </td>
                <td>zavisno od korišćenog seta guma/točkova</td>
                <td>već od <b>
                        <?= round($article['cena'] / 60) ?>€
                    </b> mesečno</td>
            </tr>
        </table>
        <p class="videoinfo">Video recenzija vozila <br><span><a
                    href="./index.php?module=salon&id=<?= $article['salon_id'] ?>#video" class="strela"><i
                        class="fa-solid fa-angle-down"></i></a></span></p>

    </div>
    <div id="video" style="margin-left: 18%; margin-right: 25%;">
        <?= $article['recenzija'] ?>
    </div>
</main>