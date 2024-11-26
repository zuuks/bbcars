<footer>
    <p id="footerP">Copyright &copy; BB Cars, Nikole Pasica 28, Nis 18000</p>
</footer>
<script>
    window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        const moduleParam = urlParams.get('module');
        const actionParam = urlParams.get('action');
        var body = document.body;
        var header = document.querySelector('header');

        if (!moduleParam) {
            body.style.backgroundImage = "url(<?= DIR_PUBLIC_IMAGES . 'bg1.jpg' ?>)";
            body.style.backgroundColor = "white";
            header.style.backgroundColor = "none";
        } else if (!moduleParam || (moduleParam === 'salon' && actionParam === 'submit' || actionParam === 'edit' || actionParam === 'delete')) {
            body.style.backgroundImage = "url(<?= DIR_PUBLIC_IMAGES . 'kontaktbg.jpg' ?>)";
            body.style.backgroundColor = "white";
            header.style.backgroundColor = "rgb(87, 135, 144)";
        } else if (moduleParam === 'salon' || moduleParam === 'prodavnica' ) {
            body.style.backgroundImage = "none";
            body.style.backgroundColor = "white";
            header.style.backgroundColor = "rgb(87, 135, 144)";
        } else if (moduleParam === 'admin-panel' || moduleParam === 'korisnici'|| moduleParam === 'statistics' ) {
            body.style.backgroundImage = "none";
            body.style.backgroundColor = "#1A1A1A";
            header.style.backgroundColor = "rgb(87, 135, 144)";
        } else if (moduleParam === 'contact' ) {
            body.style.backgroundImage = "url(<?= DIR_PUBLIC_IMAGES . 'kontaktbg.jpg' ?>)";
            body.style.backgroundColor = "white";
            header.style.backgroundColor = "rgb(87, 135, 144)";
        }else{
            body.style.backgroundImage = "none";
            body.style.backgroundColor = "white";
            header.style.backgroundColor = "rgb(87, 135, 144)";
        }
    };
</script>
</body>

</html>