<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Navigation Menus</h2>
        <p class="text-muted">Drag and drop rows to reorder. Changes are saved automatically.</p>
    </div>
    <a href="/admin/menus/new" class="btn btn-primary"><i class="ph ph-plus me-1"></i> Add Menu Item</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="40"></th>
                    <th>Label</th>
                    <th>URL</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-menu">
                <?php foreach ($menus as $m): ?>
                    <tr data-id="<?= $m['id'] ?>" class="sortable-row">
                        <td class="drag-handle" style="cursor: move;">
                            <i class="ph ph-dots-six-vertical fs-5 text-muted"></i>
                        </td>
                        <td>
                            <strong class="text-dark"><?= esc($m['label']) ?></strong>
                            <?php if ($m['color']): ?>
                                <div style="width: 12px; height: 12px; background: <?= esc($m['color']) ?>; display: inline-block; border-radius: 2px; margin-left: 4px; box-shadow: 0 0 0 1px rgba(0,0,0,0.1);"></div>
                            <?php endif; ?>
                        </td>
                        <td><code class="bg-light px-2 py-1 rounded text-primary small"><?= esc($m['url']) ?></code></td>
                        <td>
                            <?php 
                            if ($m['parent_id']) {
                                foreach ($menus as $p) {
                                    if ($p['id'] == $m['parent_id']) {
                                        echo '<span class="text-muted small">' . esc($p['label']) . '</span>';
                                        break;
                                    }
                                }
                            } else {
                                echo '<span class="badge bg-light text-muted border fw-normal">Root Item</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($m['is_active']): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-light text-muted border fw-normal">Hidden</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="/admin/menus/<?= $m['id'] ?>/edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>
                                <form method="post" action="/admin/menus/<?= $m['id'] ?>/delete" class="m-0">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Delete"><i class="ph ph-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($menus)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No menu items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('extra-js') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('sortable-menu');
    if (!el) return;

    Sortable.create(el, {
        animation: 150,
        handle: '.drag-handle',
        ghostClass: 'bg-light',
        onEnd: function (evt) {
            const rows = el.querySelectorAll('tr');
            const order = Array.from(rows).map(row => row.getAttribute('data-id'));
            
            el.style.opacity = '0.5';

            fetch('/admin/menus/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ 'order': order })
            })
            .then(response => response.json())
            .then(data => {
                el.style.opacity = '1';
                if (data.status === 'success') {
                    Toastify({
                        text: "Navigation order updated!",
                        duration: 2000,
                        style: { background: "#10b981" }
                    }).showToast();
                } else {
                    alert('Error updating order');
                    window.location.reload();
                }
            })
            .catch(error => {
                el.style.opacity = '1';
                console.error('Error:', error);
            });
        }
    });
});
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
