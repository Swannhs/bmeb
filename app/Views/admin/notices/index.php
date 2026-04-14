<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2>Notices</h2>
        <p class="subtle">Manage site notices and announcements.</p>
    </div>
    <div class="toolbar" style="margin-bottom:0;">
        <a class="btn" href="/admin/notices/new">New Notice</a>
    </div>
</div>

<div class="panel panel-pad">
    <form method="get" class="toolbar">
        <input style="max-width:320px;" type="search" name="search" placeholder="Search notices" value="<?= esc($search) ?>">
        <button type="submit">Filter</button>
    </form>

    <?php if (session()->has('success')): ?>
        <div style="padding: 10px; background: #e6f4ea; color: #1e8e3e; margin-bottom: 15px; border-radius: 4px;">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div style="padding: 10px; background: #fce8e6; color: #d93025; margin-bottom: 15px; border-radius: 4px;">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Publish Date</th>
            <th>Category</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($notices as $notice): ?>
            <tr>
                <td>
                    <strong><?= esc($notice['title'] ?: '(Untitled)') ?></strong><br>
                    <span class="subtle"><?= esc($notice['slug']) ?></span>
                </td>
                <td><?= esc($notice['publish_date']) ?></td>
                <td><span class="pill"><?= esc($notice['category'] ?: 'general') ?></span></td>
                <td>
                    <?php if ($notice['is_new']): ?>
                        <span class="pill" style="background:#fce8e6; color:#d93025;">New</span>
                    <?php else: ?>
                        <span class="subtle">Standard</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="table-actions">
                        <a class="btn secondary" href="/admin/notices/<?= esc((string) $notice['id']) ?>/edit">Edit</a>
                        <a class="btn secondary" href="/pages/notices/<?= esc($notice['slug']) ?>" target="_blank" rel="noreferrer">View</a>
                        <form class="inline" method="post" action="/admin/notices/<?= esc((string) $notice['id']) ?>/delete" onsubmit="return confirm('Delete this notice?');">
                            <button type="submit" class="btn danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($notices)): ?>
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;" class="subtle">No notices found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?= $pager->links() ?>
    </div>
</div>
<?= $this->endSection() ?>
