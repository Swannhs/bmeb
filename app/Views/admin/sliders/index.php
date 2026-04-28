<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Sliders</h2>
    <a href="<?= base_url('admin/sliders/create') ?>" class="btn btn-primary">Add New Slider</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <p class="text-muted small mb-3"><i class="ph ph-hand-grabbing me-1"></i> Drag rows to reorder how they appear on the homepage.</p>
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="40"></th>
                    <th width="150">Image Preview</th>
                    <th>Image URL</th>
                    <th width="150" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody id="sliders-list">
                <?php if (!empty($sliders)): ?>
                    <?php foreach ($sliders as $slider): ?>
                        <tr data-id="<?= $slider['id'] ?>" style="cursor: move;">
                            <td><i class="ph ph-dots-six-vertical fs-5 text-muted"></i></td>
                            <td>
                                <img src="<?= esc($slider['image_url']) ?>" style="height: 50px; width: 100px; object-fit: cover; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            </td>
                            <td><div class="text-truncate" style="max-width: 300px;" title="<?= esc($slider['image_url']) ?>"><?= esc($slider['image_url']) ?></div></td>
                            <td class="text-end">
                                <a href="<?= base_url('admin/sliders/edit/' . $slider['id']) ?>" class="btn btn-sm btn-outline-primary" title="Edit"><i class="ph ph-pencil-simple"></i> Edit</a>
                                <a href="<?= base_url('admin/sliders/delete/' . $slider['id']) ?>" class="btn btn-sm btn-outline-danger btn-delete" title="Delete"><i class="ph ph-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No sliders found. Click 'Add New Slider' to create one.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('extra-js') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('sliders-list');
    if (!el) return;

    Sortable.create(el, {
        animation: 150,
        ghostClass: 'bg-light',
        onEnd: function() {
            const order = Array.from(el.querySelectorAll('tr')).map(tr => tr.getAttribute('data-id'));
            
            fetch('<?= base_url('admin/sliders/reorder') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ 'order': order })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Toastify({
                        text: "New order saved!",
                        duration: 2000,
                        style: { background: "#10b981" }
                    }).showToast();
                }
            });
        }
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
