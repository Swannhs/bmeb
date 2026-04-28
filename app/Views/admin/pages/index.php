<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Pages</h2>
        <p class="text-muted">Edit imported mirror pages or create fully native dynamic ones.</p>
    </div>
    <div class="d-flex gap-2">
        <form method="post" action="/admin/pages/import" class="m-0">
            <button type="submit" class="btn btn-outline-info"><i class="ph ph-download-simple me-1"></i> Import Mirror Pages</button>
        </form>
        <a href="/admin/pages/new" class="btn btn-primary"><i class="ph ph-plus me-1"></i> New Page</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle datatable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Route</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td>
                            <strong class="text-dark"><?= esc($page['title'] ?: '(Untitled)') ?></strong><br>
                            <span class="text-muted small"><?= esc($page['source_type']) ?></span>
                        </td>
                        <td>
                            <code class="bg-light px-2 py-1 rounded text-primary">/p/<?= esc($page['slug'] ?: $page['route_key']) ?></code>
                        </td>
                        <td><span class="badge bg-secondary"><?= esc($page['section'] ?: 'other') ?></span></td>
                        <td>
                            <?php if($page['status'] === 'published'): ?>
                                <span class="badge bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-muted small"><?= date('M j, Y g:i A', strtotime($page['updated_at'])) ?></td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a class="btn btn-sm btn-outline-info" href="/p/<?= esc($page['slug'] ?: $page['route_key']) ?>" target="_blank" rel="noreferrer" title="View"><i class="ph ph-eye"></i></a>
                                <a class="btn btn-sm btn-outline-primary" href="/admin/pages/<?= esc((string) $page['id']) ?>/edit" title="Edit Properties"><i class="ph ph-gear"></i></a>
                                <a class="btn btn-sm btn-outline-success" href="/admin/pages/<?= esc((string) $page['id']) ?>/builder" title="Visual Builder"><i class="ph ph-paint-brush"></i></a>
                                <form method="post" action="/admin/pages/<?= esc((string) $page['id']) ?>/delete" class="m-0">
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
