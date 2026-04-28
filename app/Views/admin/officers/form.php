<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><?= $officer['id'] ? 'Edit Officer' : 'New Officer' ?></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/admin/officers" class="text-decoration-none">Officers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $officer['id'] ? 'Edit' : 'Create' ?></li>
            </ol>
        </nav>
    </div>
    <a href="/admin/officers" class="btn btn-outline-secondary"><i class="ph ph-arrow-left me-1"></i> Back</a>
</div>

<div class="card shadow-sm" style="max-width: 800px;">
    <div class="card-body p-4">
        <form method="post" action="<?= $officer['id'] ? "/admin/officers/{$officer['id']}" : "/admin/officers" ?>">
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required value="<?= esc(old('name', $officer['name'])) ?>">
                </div>
                <div class="col-md-6">
                    <label for="designation" class="form-label fw-semibold">Designation <span class="text-danger">*</span></label>
                    <input type="text" id="designation" name="designation" class="form-control" required value="<?= esc(old('designation', $officer['designation'])) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="office" class="form-label fw-semibold">Office/Department</label>
                <input type="text" id="office" name="office" class="form-control" value="<?= esc(old('office', $officer['office'])) ?>">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone_office" class="form-label fw-semibold">Phone (Office)</label>
                    <input type="text" id="phone_office" name="phone_office" class="form-control" value="<?= esc(old('phone_office', $officer['phone_office'])) ?>">
                </div>
                <div class="col-md-6">
                    <label for="mobile" class="form-label fw-semibold">Mobile</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" value="<?= esc(old('mobile', $officer['mobile'])) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= esc(old('email', $officer['email'])) ?>">
            </div>

            <div class="mb-3">
                <label for="photo_url" class="form-label fw-semibold">Photo URL</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="ph ph-image"></i></span>
                    <input type="url" id="photo_url" name="photo_url" class="form-control" value="<?= esc(old('photo_url', $officer['photo_url'])) ?>">
                </div>
            </div>

            <div class="mb-4">
                <label for="sort_order" class="form-label fw-semibold">Display Order</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" value="<?= esc(old('sort_order', $officer['sort_order'])) ?>" style="max-width: 150px;">
                <div class="form-text">Lower numbers appear first.</div>
            </div>

            <div class="d-flex gap-2 border-top pt-4">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="ph ph-floppy-disk me-2"></i><?= $officer['id'] ? 'Save Changes' : 'Add Officer' ?></button>
                <a href="/admin/officers" class="btn btn-light border px-4 py-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
