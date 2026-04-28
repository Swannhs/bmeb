<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Homepage Sections</h2>
        <p class="text-muted">Drag and drop to reorder sections. Changes are saved automatically.</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="40"></th>
                    <th>Section Key</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody id="sections-list">
                <?php foreach ($sections as $s): ?>
                    <tr data-id="<?= $s['id'] ?>">
                        <td><span class="sortable-handle" style="cursor: move;"><i class="ph ph-dots-six-vertical fs-5 text-muted"></i></span></td>
                        <td><code class="bg-light px-2 py-1 rounded text-primary small"><?= esc($s['section_key']) ?></code></td>
                        <td><strong class="text-dark"><?= esc($s['title']) ?></strong></td>
                        <td><span class="badge bg-light text-dark border fw-normal"><?= esc($s['type']) ?></span></td>
                        <td>
                            <?php if ($s['is_active']): ?>
                                <span class="badge bg-success">Visible</span>
                            <?php else: ?>
                                <span class="badge bg-light text-muted border fw-normal">Hidden</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary px-3" href="/admin/home-sections/<?= $s['id'] ?>/edit">
                                <i class="ph ph-pencil-simple me-1"></i> Edit Content
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('extra-js') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('sections-list');
    if (!el) return;

    Sortable.create(el, {
        handle: '.sortable-handle',
        ghostClass: 'bg-light',
        animation: 150,
        onEnd: function() {
            const orders = [];
            el.querySelectorAll('tr').forEach((tr, index) => {
                orders.push({
                    id: tr.dataset.id,
                    sort_order: index + 1
                });
            });

            el.style.opacity = '0.5';

            fetch('/admin/home-sections/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(orders)
            })
            .then(response => response.json())
            .then(data => {
                el.style.opacity = '1';
                if (data.status === 'success') {
                    Toastify({
                        text: "Homepage layout updated!",
                        duration: 2000,
                        style: { background: "#10b981" }
                    }).showToast();
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
