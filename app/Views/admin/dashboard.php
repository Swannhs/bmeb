<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Welcome back, Admin! 👋</h2>
        <p class="text-muted">Here is what's happening with your website today.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Stat Card: Pages -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-primary me-3" style="width: 56px; height: 56px;">
                    <i class="ph ph-files fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Pages</h6>
                    <h3 class="mb-0 fw-bold text-dark"><?= esc($totalPages) ?></h3>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-4 d-flex justify-content-between text-muted" style="font-size: 0.85rem;">
                <span><span class="text-success fw-semibold"><?= esc($publishedPages) ?></span> Published</span>
                <span><span class="text-warning fw-semibold"><?= esc($draftPages) ?></span> Drafts</span>
            </div>
        </div>
    </div>

    <!-- Stat Card: Notices -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-success me-3" style="width: 56px; height: 56px;">
                    <i class="ph ph-megaphone fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Notices</h6>
                    <h3 class="mb-0 fw-bold text-dark"><?= esc($totalNotices) ?></h3>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-4 text-muted" style="font-size: 0.85rem;">
                <a href="<?= base_url('admin/notices') ?>" class="text-decoration-none text-success fw-medium">Manage Notices &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Stat Card: Sliders -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #fefce8 0%, #fef08a 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-warning me-3" style="width: 56px; height: 56px;">
                    <i class="ph ph-images fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Active Sliders</h6>
                    <h3 class="mb-0 fw-bold text-dark"><?= esc($totalSliders ?? 0) ?></h3>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-4 text-muted" style="font-size: 0.85rem;">
                <a href="<?= base_url('admin/sliders') ?>" class="text-decoration-none text-warning fw-medium" style="color: #ca8a04 !important;">Update Banners &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Stat Card: Officers -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px; color: #8b5cf6;">
                    <i class="ph ph-users fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Officers</h6>
                    <h3 class="mb-0 fw-bold text-dark"><?= esc($totalOfficers) ?></h3>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-4 text-muted" style="font-size: 0.85rem;">
                <a href="<?= base_url('admin/officers') ?>" class="text-decoration-none fw-medium" style="color: #7c3aed;">Manage Directory &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Actions -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fs-6"><i class="ph ph-lightning text-warning me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="<?= base_url('admin/pages/new') ?>" class="btn btn-light text-start p-3 d-flex align-items-center border">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3"><i class="ph ph-plus fs-4"></i></div>
                        <div>
                            <div class="fw-semibold text-dark">Create New Page</div>
                            <div class="text-muted small">Use the visual builder to add a new content page.</div>
                        </div>
                    </a>
                    <a href="<?= base_url('admin/notices/new') ?>" class="btn btn-light text-start p-3 d-flex align-items-center border">
                        <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3"><i class="ph ph-megaphone fs-4"></i></div>
                        <div>
                            <div class="fw-semibold text-dark">Publish Notice</div>
                            <div class="text-muted small">Upload a new circular or notice document.</div>
                        </div>
                    </a>
                    <a href="<?= base_url('admin/sliders') ?>" class="btn btn-light text-start p-3 d-flex align-items-center border">
                        <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3"><i class="ph ph-image fs-4"></i></div>
                        <div>
                            <div class="fw-semibold text-dark">Update Homepage Sliders</div>
                            <div class="text-muted small">Change the main banner images for the website.</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fs-6"><i class="ph ph-info text-info me-2"></i>System Status</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Total Admin Users</span>
                        <span class="badge bg-secondary rounded-pill"><?= esc($totalAdmins) ?></span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">CodeIgniter Version</span>
                        <span class="fw-medium"><?= \CodeIgniter\CodeIgniter::CI_VERSION ?></span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">PHP Version</span>
                        <span class="fw-medium"><?= phpversion() ?></span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Environment</span>
                        <span class="badge bg-success">Production</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
