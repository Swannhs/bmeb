<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2><?= $officer['id'] ? 'Edit Officer' : 'New Officer' ?></h2>
        <a href="/admin/officers" class="subtle">&larr; Back to directory</a>
    </div>
</div>

<div class="panel panel-pad" style="max-width: 800px;">
    <?php if (session()->has('error')): ?>
        <div style="padding: 10px; background: #fce8e6; color: #d93025; margin-bottom: 20px; border-radius: 4px;">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= $officer['id'] ? "/admin/officers/{$officer['id']}" : "/admin/officers" ?>">
        <div class="grid cols-2" style="grid-template-columns: 1fr 1fr;">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" required value="<?= esc(old('name', $officer['name'])) ?>">
            </div>

            <div class="form-group">
                <label for="designation">Designation *</label>
                <input type="text" id="designation" name="designation" required value="<?= esc(old('designation', $officer['designation'])) ?>">
            </div>
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="office">Office/Department</label>
            <input type="text" id="office" name="office" value="<?= esc(old('office', $officer['office'])) ?>">
        </div>

        <div class="grid cols-2" style="grid-template-columns: 1fr 1fr; margin-top: 15px;">
            <div class="form-group">
                <label for="phone_office">Phone (Office)</label>
                <input type="text" id="phone_office" name="phone_office" value="<?= esc(old('phone_office', $officer['phone_office'])) ?>">
            </div>

            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" value="<?= esc(old('mobile', $officer['mobile'])) ?>">
            </div>
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= esc(old('email', $officer['email'])) ?>">
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="photo_url">Photo URL</label>
            <input type="url" id="photo_url" name="photo_url" value="<?= esc(old('photo_url', $officer['photo_url'])) ?>">
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="sort_order">Display Order</label>
            <input type="number" id="sort_order" name="sort_order" value="<?= esc(old('sort_order', $officer['sort_order'])) ?>" style="max-width: 150px;">
            <p class="subtle" style="margin-top: 5px;">Lower numbers appear first.</p>
        </div>

        <div class="form-actions" style="margin-top: 30px;">
            <button type="submit" class="btn"><?= $officer['id'] ? 'Save Changes' : 'Add Officer' ?></button>
            <a href="/admin/officers" class="btn secondary">Cancel</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
