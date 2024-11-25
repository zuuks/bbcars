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
        <header>
            <h1 class="admin">Statistika</h1>
        </header>
        
        <!-- Statistika Sekcija -->
        <section class="sekcijastatistika">
            <!-- Ostavljen prazan prostor za statistiku -->
            <div class="statistika-content">
                <!-- Dodaj statistiku ovde -->
                <canvas id="myPieChart" width="500px" height="50px"></canvas>
            </div>
        </section>
    </main>
</div>

 <!-- <script>
    // Učitaj podatke iz PHP-a
    fetch('modules/model-statistics.php') // Ovdje bi trebao biti tačan URL do PHP fajla
        .then(response => response.json())
        .then(data => {
            console.log(data); // Dodaj ovo da vidiš šta dobijaš
            // Priprema podataka za chart
            const labels = data.map(item => item.marka);
            const values = data.map(item => item.broj_vozila);

            // Kreiranje Pie Chart-a
            const ctx = document.getElementById('myPieChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)', // 1
                            'rgba(54, 162, 235, 0.2)', // 2
                            'rgba(255, 206, 86, 0.2)', // 3
                            'rgba(75, 192, 192, 0.2)', // 4
                            'rgba(153, 102, 255, 0.2)', // 5
                            'rgba(255, 159, 64, 0.2)', // 6
                            'rgba(255, 99, 132, 0.5)', // 7
                            'rgba(54, 162, 235, 0.5)', // 8
                            'rgba(255, 206, 86, 0.5)', // 9
                            'rgba(75, 192, 192, 0.5)', // 10
                            'rgba(153, 102, 255, 0.5)', // 11
                            'rgba(255, 159, 64, 0.5)', // 12
                            'rgba(255, 99, 132, 0.8)', // 13
                            'rgba(54, 162, 235, 0.8)', // 14
                            'rgba(255, 206, 86, 0.8)', // 15
                            'rgba(75, 192, 192, 0.8)', // 16
                            'rgba(153, 102, 255, 0.8)', // 17
                            'rgba(255, 159, 64, 0.8)', // 18
                            'rgba(129, 252, 108, 0.8)', // 19
                            'rgba(0, 204, 255, 0.8)', // 20
                            'rgba(204, 0, 204, 0.8)'  // 21
                        ],

                        borderColor: [
                            'rgba(255, 99, 132, 1)', // 1
                            'rgba(54, 162, 235, 1)', // 2
                            'rgba(255, 206, 86, 1)', // 3
                            'rgba(75, 192, 192, 1)', // 4
                            'rgba(153, 102, 255, 1)', // 5
                            'rgba(255, 159, 64, 1)', // 6
                            'rgba(255, 99, 132, 1)', // 7
                            'rgba(54, 162, 235, 1)', // 8
                            'rgba(255, 206, 86, 1)', // 9
                            'rgba(75, 192, 192, 1)', // 10
                            'rgba(153, 102, 255, 1)', // 11
                            'rgba(255, 159, 64, 1)', // 12
                            'rgba(255, 99, 132, 1)', // 13
                            'rgba(54, 162, 235, 1)', // 14
                            'rgba(255, 206, 86, 1)', // 15
                            'rgba(75, 192, 192, 1)', // 16
                            'rgba(153, 102, 255, 1)', // 17
                            'rgba(255, 159, 64, 1)', // 18
                            'rgba(129, 252, 108, 1)', // 19
                            'rgba(0, 204, 255, 1)', // 20
                            'rgba(204, 0, 204, 1)'  // 21
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        })
        .catch(error => console.error('Greška pri učitavanju podataka:', error));
</script> -->

<script>
    // Učitaj podatke iz PHP-a
    fetch('modules/model-statistics.php') // Ovdje bi trebao biti tačan URL do PHP fajla
        .then(response => response.json())
        .then(data => {
            console.log(data); // Provera dobijenih podataka u konzoli

            // Priprema podataka za chart
            const labels = data.map(item => item.marka);
            const values = data.map(item => item.broj_vozila);

            // Kreiranje Bar Chart-a
            const ctx = document.getElementById('myPieChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Tip grafikona
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Broj vozila po marki', // Naslov dataset-a
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)', // 1
                            'rgba(54, 162, 235, 0.2)', // 2
                            'rgba(255, 206, 86, 0.2)', // 3
                            'rgba(75, 192, 192, 0.2)', // 4
                            'rgba(153, 102, 255, 0.2)', // 5
                            'rgba(255, 159, 64, 0.2)', // 6,
                            // Dodaj više boja ako ima više podataka
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)', // 1
                            'rgba(54, 162, 235, 1)', // 2
                            'rgba(255, 206, 86, 1)', // 3
                            'rgba(75, 192, 192, 1)', // 4
                            'rgba(153, 102, 255, 1)', // 5
                            'rgba(255, 159, 64, 1)', // 6,
                            // Dodaj više boja ako ima više podataka
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true, // Prikaži legendu
                            position: 'top',
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true, // X osa počinje od 0
                            title: {
                                display: true,
                                text: 'Marke vozila',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        y: {
                            beginAtZero: true, // Y osa počinje od 0
                            title: {
                                display: true,
                                text: 'Broj vozila',
                                font: {
                                    size: 14
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Greška pri učitavanju podataka:', error));
</script>

<!-- <script>
    // Učitaj podatke iz PHP-a
    fetch('modules/model-statistics.php') // Ovdje bi trebao biti tačan URL do PHP fajla
        .then(response => response.json())
        .then(data => {
            //console.log(data); // Proveri dobijene podatke u konzoli
            // Priprema podataka za chart
            const labels = data.map(item => item.marka);
            const values = data.map(item => item.broj_vozila);

            // Kreiranje Line Chart-a
            const ctx = document.getElementById('myPieChart').getContext('2d');
            new Chart(ctx, {
                type: 'line', // Promenjeno na 'line'
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Broj vozila',
                        data: values,
                        fill: false, // Onemogućeno popunjavanje ispod linije
                        borderColor: 'rgba(75, 192, 192, 1)', // Boja linije
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Boja tačaka
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Boja tačaka
                        pointBorderColor: 'rgba(75, 192, 192, 1)', // Boja ivica tačaka
                        borderWidth: 2, // Debljina linije
                        pointRadius: 4, // Veličina tačaka
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top', // Pozicija legende
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true // Početak od 0 na X osi
                        },
                        y: {
                            beginAtZero: true // Početak od 0 na Y osi
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Greška pri učitavanju podataka:', error));
</script> -->
