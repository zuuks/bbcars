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

<div>
<section class="sekcijaadmin">
        <h1>Korisnici</h1>
        <?php if (!empty($message)): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <?php if ($totalPages > 1): ?>
    
<?php endif; ?>
       <div class="koristabela">
       <nav class="pagination">
        <?php if ($page > 1): ?>
            <a href="?module=korisnici&page=<?= $page - 1 ?>">Prethodna</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?module=korisnici&page=<?= $i ?>" class="<?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
        
        <?php if ($page < $totalPages): ?>
            <a href="?module=korisnici&page=<?= $page + 1 ?>">Sledeća</a>
        <?php endif; ?>
    </nav>
       <table class="korisnici-tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Korisničko ime</th>
                    <th>User Level</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['user_level']) ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($row['id']) ?>">
                                    <button type="submit" name="ban_user" class="ban-button">Ban</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nema korisnika u bazi podataka.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
       </div>
                </section>
    </div>
