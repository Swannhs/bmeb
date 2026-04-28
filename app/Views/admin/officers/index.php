<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Officers</h2>
        <p class="text-muted">Manage key officers contact directory.</p>
    </div>
    <a href="/admin/officers/new" class="btn btn-primary"><i class="ph ph-plus me-1"></i> New Officer</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle datatable">
            <thead>
                <tr>
                    <th width="80">Order</th>
                    <th width="80">Photo</th>
                    <th>Name & Desig.</th>
                    <th>Contact</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($officers as $officer): ?>
                    <tr>
                        <td><span class="badge bg-light text-dark border"><?= esc($officer['sort_order']) ?></span></td>
                        <td>
                            <?php if ($officer['photo_url']): ?>
                                <img src="<?= esc($officer['photo_url']) ?>" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.1);" alt="">
                            <?php else: ?>
                                <div class="bg-light border text-muted d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">
                                    <i class="ph ph-user fs-4"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong class="text-dark d-block"><?= esc($officer['name']) ?></strong>
                            <span class="text-primary small d-block"><?= esc($officer['designation']) ?></span>
                            <span class="text-muted small" style="font-size: 12px;"><i class="ph ph-buildings me-1"></i><?= esc($officer['office']) ?></span>
                        </td>
                        <td style="font-size: 13px;">
                            <?php if($officer['email']): ?><div class="mb-1"><i class="ph ph-envelope-simple text-muted me-1"></i> <?= esc($officer['email']) ?></div><?php endif; ?>
                            <?php if($officer['phone_office']): ?><div class="mb-1"><i class="ph ph-phone text-muted me-1"></i> <?= esc($officer['phone_office']) ?></div><?php endif; ?>
                            <?php if($officer['mobile']): ?><div><i class="ph ph-device-mobile text-muted me-1"></i> <?= esc($officer['mobile']) ?></div><?php endif; ?>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="/admin/officers/<?= esc((string) $officer['id']) ?>/edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>
                                <form method="post" action="/admin/officers/<?= esc((string) $officer['id']) ?>/delete" class="m-0">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Delete"><i class="ph ph-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
