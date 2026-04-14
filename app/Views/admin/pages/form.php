<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2><?= $page === null ? 'Create Page' : 'Edit Page' ?></h2>
        <p class="subtle">This editor stores the full HTML page so the current front-end design stays intact.</p>
    </div>
    <a class="btn secondary" href="/admin/pages">Back</a>
</div>

<div class="panel panel-pad">
    <form method="post" action="<?= $page === null ? '/admin/pages' : '/admin/pages/' . $page['id'] ?>">
        <div class="grid cols-2">
            <div class="field">
                <label for="title">Title</label>
                <input id="title" name="title" value="<?= esc((string) old('title', $page['title'] ?? '')) ?>">
                <?php if (isset($errors['title'])): ?><div class="error"><?= esc($errors['title']) ?></div><?php endif; ?>
            </div>
            <div class="field">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <?php $status = (string) old('status', $page['status'] ?? 'published'); ?>
                    <option value="published" <?= $status === 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="draft" <?= $status === 'draft' ? 'selected' : '' ?>>Draft</option>
                </select>
                <?php if (isset($errors['status'])): ?><div class="error"><?= esc($errors['status']) ?></div><?php endif; ?>
            </div>
        </div>

        <div class="field">
            <label for="route_key">Route Key</label>
            <input id="route_key" name="route_key" value="<?= esc((string) old('route_key', $page['route_key'] ?? '')) ?>" placeholder="/pages/notices">
            <div class="hint">Examples: `/`, `/pages/notices`, `/pages/static-pages/691997bd933eb65569ddeb2d`</div>
            <?php if (isset($errors['route_key'])): ?><div class="error"><?= esc($errors['route_key']) ?></div><?php endif; ?>
        </div>

        <div class="field">
            <label for="source_path">Source Path</label>
            <input id="source_path" name="source_path" value="<?= esc((string) old('source_path', $page['source_path'] ?? '')) ?>" placeholder="public/pages/notices.html">
        </div>

        <div class="field">
            <label for="html_content">HTML Content</label>
            <textarea id="html_content" name="html_content"><?= esc((string) old('html_content', $page['html_content'] ?? '')) ?></textarea>
            <?php if (isset($errors['html_content'])): ?><div class="error"><?= esc($errors['html_content']) ?></div><?php endif; ?>
        </div>

        <div class="toolbar">
            <button type="submit">Save Page</button>
            <?php if ($page !== null): ?>
                <a class="btn secondary" target="_blank" rel="noreferrer" href="<?= esc($page['route_key']) ?>">Preview</a>
            <?php endif; ?>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
