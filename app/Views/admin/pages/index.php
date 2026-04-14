<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2>Pages</h2>
        <p class="subtle">Edit imported mirror pages or create fully native dynamic ones.</p>
    </div>
    <div class="toolbar" style="margin-bottom:0;">
        <form class="inline" method="post" action="/admin/pages/import">
            <button type="submit" class="btn secondary">Import Missing Mirror Pages</button>
        </form>
        <a class="btn" href="/admin/pages/new">New Page</a>
    </div>
</div>

<div class="panel panel-pad">
    <form method="get" class="toolbar">
        <input style="max-width:320px;" type="search" name="search" placeholder="Search title or route" value="<?= esc($search) ?>">
        <select style="max-width:220px;" name="section">
            <option value="">All sections</option>
            <?php foreach ($sections as $item): ?>
                <?php if ($item !== null && $item !== ''): ?>
                    <option value="<?= esc($item) ?>" <?= $section === $item ? 'selected' : '' ?>><?= esc($item) ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Route</th>
            <th>Section</th>
            <th>Status</th>
            <th>Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td>
                    <strong><?= esc($page['title'] ?: '(Untitled)') ?></strong><br>
                    <span class="subtle"><?= esc($page['source_type']) ?></span>
                </td>
                <td><code><?= esc($page['route_key']) ?></code></td>
                <td><span class="pill"><?= esc($page['section'] ?: 'other') ?></span></td>
                <td><span class="pill"><?= esc($page['status']) ?></span></td>
                <td class="subtle"><?= esc((string) $page['updated_at']) ?></td>
                <td>
                    <div class="table-actions">
                        <a class="btn secondary" href="/admin/pages/<?= esc((string) $page['id']) ?>/edit">Edit</a>
                        <a class="btn secondary" href="<?= esc($page['route_key']) ?>" target="_blank" rel="noreferrer">View</a>
                        <form class="inline" method="post" action="/admin/pages/<?= esc((string) $page['id']) ?>/delete" onsubmit="return confirm('Delete this page?');">
                            <button type="submit" class="btn danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?= $pager->links() ?>
    </div>
</div>
<?= $this->endSection() ?>
