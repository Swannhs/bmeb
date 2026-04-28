<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Notices</h2>
        <p class="text-muted">Manage site notices and announcements.</p>
    </div>
    <a href="/admin/notices/new" class="btn btn-primary"><i class="ph ph-plus me-1"></i> New Notice</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle datatable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Publish Date</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notices as $notice): ?>
                    <tr>
                        <td>
                            <strong class="text-dark"><?= esc($notice['title'] ?: '(Untitled)') ?></strong><br>
                            <span class="text-muted small"><?= esc($notice['slug']) ?></span>
                        </td>
                        <td><?= esc($notice['publish_date']) ?></td>
                        <td><span class="badge bg-secondary"><?= esc($notice['category'] ?: 'general') ?></span></td>
                        <td>
                            <?php if ($notice['is_new']): ?>
                                <span class="badge bg-danger">New</span>
                            <?php else: ?>
                                <span class="badge bg-light text-dark border">Standard</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a class="btn btn-sm btn-outline-info" href="/pages/notices/<?= esc($notice['slug']) ?>" target="_blank" rel="noreferrer" title="View"><i class="ph ph-eye"></i></a>
                                <a class="btn btn-sm btn-outline-primary" href="/admin/notices/<?= esc((string) $notice['id']) ?>/edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>
                                <form method="post" action="/admin/notices/<?= esc((string) $notice['id']) ?>/delete" class="m-0">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Delete"><i class="ph ph-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php if (!empty($pager)): ?>
            <div class="mt-4 d-flex justify-content-end">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
