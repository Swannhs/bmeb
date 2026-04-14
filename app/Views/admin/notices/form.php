<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2><?= $notice['id'] ? 'Edit Notice' : 'New Notice' ?></h2>
        <a href="/admin/notices" class="subtle">&larr; Back to notices</a>
    </div>
</div>

<div class="panel panel-pad" style="max-width: 800px;">
    <?php if (session()->has('error')): ?>
        <div style="padding: 10px; background: #fce8e6; color: #d93025; margin-bottom: 20px; border-radius: 4px;">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= $notice['id'] ? "/admin/notices/{$notice['id']}" : "/admin/notices" ?>">
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" required value="<?= esc(old('title', $notice['title'])) ?>">
        </div>

        <div class="form-group">
            <label for="slug">Slug (URL snippet) *</label>
            <input type="text" id="slug" name="slug" required value="<?= esc(old('slug', $notice['slug'])) ?>">
            <p class="subtle" style="margin-top: 5px;">Must be unique. Alphanumeric and dashes only.</p>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" value="<?= esc(old('category', $notice['category'])) ?>">
        </div>

        <div class="form-group">
            <label for="publish_date">Publish Date</label>
            <input type="date" id="publish_date" name="publish_date" required value="<?= esc(old('publish_date', $notice['publish_date'] ? date('Y-m-d', strtotime($notice['publish_date'])) : date('Y-m-d'))) ?>">
        </div>

        <div class="form-group">
            <label for="file_path">Attachment URL (File Path)</label>
            <input type="text" id="file_path" name="file_path" value="<?= esc(old('file_path', $notice['file_path'])) ?>">
            <p class="subtle" style="margin-top: 5px;">URL to the PDF or document associated with this notice.</p>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>
                <input type="hidden" name="is_new" value="0">
                <input type="checkbox" name="is_new" value="1" <?= old('is_new', $notice['is_new']) ? 'checked' : '' ?>>
                Mark as "New" (shows blinking new tag)
            </label>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label for="content">Description / Content</label>
            <textarea id="content" name="content" rows="10"><?= esc(old('content', $notice['content'])) ?></textarea>
        </div>

        <div class="form-actions" style="margin-top: 30px;">
            <button type="submit" class="btn"><?= $notice['id'] ? 'Save Changes' : 'Create Notice' ?></button>
            <a href="/admin/notices" class="btn secondary">Cancel</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
