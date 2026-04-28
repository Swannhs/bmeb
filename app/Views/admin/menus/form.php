<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2><?= $menu === null ? 'Add Menu Item' : 'Edit Menu Item' ?></h2>
        <p class="subtle">Configure how this link appears in the main navigation.</p>
    </div>
    <a class="btn secondary" href="/admin/menus">Back</a>
</div>

<div class="panel panel-pad">
    <form method="post" action="<?= $menu === null ? '/admin/menus' : '/admin/menus/' . $menu['id'] ?>">
        <div class="grid cols-2">
            <div class="field">
                <label for="label">Label (Bangla)</label>
                <input id="label" name="label" value="<?= esc((string) old('label', $menu['label'] ?? '')) ?>" required>
                <?php if (isset($errors['label'])): ?><div class="error"><?= esc($errors['label']) ?></div><?php endif; ?>
            </div>
            <div class="field">
                <label for="url">URL / Route</label>
                <input id="url" name="url" value="<?= esc((string) old('url', $menu['url'] ?? '')) ?>" placeholder="/" required>
                <div class="hint">Use <code>/</code> for home, <code>#</code> for parent items, or full URL for external.</div>
                <?php if (isset($errors['url'])): ?><div class="error"><?= esc($errors['url']) ?></div><?php endif; ?>
            </div>
        </div>

        <div class="grid cols-2">
            <div class="field">
                <label for="parent_id">Parent Menu</label>
                <select id="parent_id" name="parent_id">
                    <option value="">None (Top Level)</option>
                    <?php foreach ($parents as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= (old('parent_id', $menu['parent_id'] ?? '') == $p['id']) ? 'selected' : '' ?>>
                            <?= esc($p['label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="<?= esc((string) old('order', $menu['order'] ?? '0')) ?>">
            </div>
        </div>

        <div class="grid cols-2">
            <div class="field">
                <label for="color">Theme Color (Hex)</label>
                <input id="color" name="color" type="text" value="<?= esc((string) old('color', $menu['color'] ?? '')) ?>" placeholder="#FF4500">
                <div class="hint">Only applied to top-level items.</div>
            </div>
            <div class="field">
                <label for="target">Link Target</label>
                <select id="target" name="target">
                    <option value="_self" <?= old('target', $menu['target'] ?? '') === '_self' ? 'selected' : '' ?>>Same Window (_self)</option>
                    <option value="_blank" <?= old('target', $menu['target'] ?? '') === '_blank' ? 'selected' : '' ?>>New Window (_blank)</option>
                </select>
            </div>
        </div>

        <div class="field">
            <label>
                <input type="checkbox" name="is_active" value="1" <?= old('is_active', $menu['is_active'] ?? '1') == '1' ? 'checked' : '' ?> style="width: auto;">
                Item is visible in Navbar
            </label>
        </div>

        <div class="toolbar">
            <button type="submit">Save Menu Item</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
