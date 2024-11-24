<div class="admin-panel">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Automobili</a></li>
                    <li><a href="#">Korisnici</a></li>
                    <li><a href="#">Postavke</a></li>
                    <li><a href="#">Izloguj se</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <header>
                <h1>Dobrodošli, Admin</h1>
                <button class="btn-primary">Dodaj novi automobil</button>
            </header>
            
            <!-- Data Table -->
            <section>
                <h2>Lista Automobila</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Model</th>
                            <th>Godina</th>
                            <th>Kilometraža</th>
                            <th>Cena (€)</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Audi A4</td>
                            <td>2018</td>
                            <td>120,000</td>
                            <td>25,000</td>
                            <td>
                                <button class="btn-edit">Izmeni</button>
                                <button class="btn-delete">Obriši</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>BMW 320d</td>
                            <td>2020</td>
                            <td>80,000</td>
                            <td>30,000</td>
                            <td>
                                <button class="btn-edit">Izmeni</button>
                                <button class="btn-delete">Obriši</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>