<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="admin-panel">

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

   
    <main class="content">
        <header>
            <h1 class="admin">Statistika</h1>
        </header>

     
        <section class="sekcijastatistika">
            
            <div class="statistika-content">
               
                <canvas id="vozilaNaStanju" width="500px" height="50px"></canvas>
            </div>
            <div class="statistika-content">
                
                <canvas id="prodataVozila" width="500px" height="50px"></canvas>
            </div>
            <div class="statistika-content">
               
                <canvas id="prodatiPoslednjihSestMeseci" width="500px" height="50px"></canvas>
            </div>
        </section>
    </main>
</div>

<script>

    $(document).ready(function () {
        
       
        $.ajax({
            url: './modules/model-statistics.php', 
            method: 'GET', 
            dataType: 'json', 
            data: { action: 'vadi' }, 
            success: function (data) {
                //VOZILA NA STANJU KOJA SE PRODAJU
                const labelsMarka = data.marke.map(item => item.marka);
                const valuesMarka = data.marke.map(item => item.broj_vozila);

       
                const ctxMarka = document.getElementById('vozilaNaStanju');
                if (ctxMarka) {
                    const chartMarka = new Chart(ctxMarka.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labelsMarka,
                            datasets: [{
                                label: 'Broj vozila po marki koji su na prodaji',
                                data: valuesMarka,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)', 
                                    'rgba(54, 162, 235, 0.2)', 
                                    'rgba(255, 206, 86, 0.2)', 
                                    'rgba(75, 192, 192, 0.2)', 
                                    'rgba(153, 102, 255, 0.2)', 
                                    'rgba(255, 159, 64, 0.2)', 
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Marke vozila',
                                        font: {
                                            size: 14
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
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
                }
                //PRODATA VOZILA ZA SVE GODINE
                const labelsGodina = data.prodaja.map(item => item.godina);
                const valuesProdaja = data.prodaja.map(item => item.broj_prodatih_vozila);

                const ctxProdaja = document.getElementById('prodataVozila');
                if (ctxProdaja) {
                    const chartProdaja = new Chart(ctxProdaja.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: labelsGodina,
                            datasets: [{
                                label: 'Broj prodatih vozila po godinama',
                                data: valuesProdaja,
                                backgroundColor: [
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Godina',
                                        font: {
                                            size: 14
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Broj prodatih vozila',
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                //PRODATA VOZILA ZA 6 MESECI
                const labelsMarka6 = data.prodaja6.map(item => item.marka);
                const valuesMarka6 = data.prodaja6.map(item => item.broj_prodatih_vozila_poslednjih_6_meseci);

                const ctxMarka6 = document.getElementById('prodatiPoslednjihSestMeseci');
                if (ctxMarka6) {
                    const chartMarka6 = new Chart(ctxMarka6.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labelsMarka6,
                            datasets: [{
                                label: 'Broj vozila po marki koji su prodati poslednjih 6 meseci',
                                data: valuesMarka6,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Marke vozila',
                                        font: {
                                            size: 14
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
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
                } 
            },
            error: function (error) {
                console.error('Greška pri učitavanju podataka:', error);
            }
        });
    });
</script>

