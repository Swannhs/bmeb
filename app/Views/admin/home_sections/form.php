<?= $this->extend('admin/layout') ?>

<?= $this->section('extra-css') ?>
<link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
<style>
    #gjs { border: 1px solid #ddd; border-radius: 8px; margin-top: 10px; background: #fff; }
    .widget-editor-container { background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; }
    .link-item { display: flex; gap: 10px; margin-bottom: 10px; align-items: center; background: #fff; padding: 10px; border-radius: 6px; border: 1px solid #e5e7eb; }
    .preview-img { max-width: 200px; max-height: 200px; display: block; margin-top: 10px; border-radius: 4px; border: 1px solid #ddd; }
    .btn-remove { color: #ef4444; cursor: pointer; }
    .btn-add { margin-top: 10px; display: inline-flex; align-items: center; gap: 5px; color: #0b6bcb; cursor: pointer; font-weight: 600; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2>Edit Homepage Section: <?= esc($section['title']) ?></h2>
        <p class="subtle">Modify the content for this specific part of the homepage.</p>
    </div>
    <a class="btn secondary" href="/admin/home-sections">Back</a>
</div>

<div class="panel panel-pad">
    <form action="/admin/home-sections/<?= $section['id'] ?>" method="POST" id="section-form">
        <div class="field">
            <label>Section Title</label>
            <input type="text" name="title" value="<?= esc($section['title']) ?>" required>
        </div>

        <div class="field">
            <label>Visibility</label>
            <select name="is_active">
                <option value="1" <?= $section['is_active'] ? 'selected' : '' ?>>Visible</option>
                <option value="0" <?= !$section['is_active'] ? 'selected' : '' ?>>Hidden</option>
            </select>
        </div>

        <div class="field">
            <label>Position</label>
            <select name="position">
                <option value="main" <?= $section['position'] === 'main' ? 'selected' : '' ?>>Main Body</option>
                <option value="right" <?= $section['position'] === 'right' ? 'selected' : '' ?>>Right Sidebar</option>
            </select>
        </div>

        <input type="hidden" name="json_content" id="json-content-hidden">

        <?php if ($section['type'] === 'html'): ?>
            <div class="field">
                <label>Visual Content Editor (Elementor-like)</label>
                <div id="gjs" style="height: 600px;"></div>
                <input type="hidden" name="content" id="html-content">
            </div>
        <?php elseif ($section['section_key'] === 'chairman'): ?>
            <?php $chairman = json_decode($section['content'], true); ?>
            <div class="field">
                <label>Chairman Information</label>
                <div class="widget-editor-container" id="chairman-editor">
                    <div class="field">
                        <label>Name</label>
                        <input type="text" class="chairman-input" data-key="name" value="<?= esc($chairman['name'] ?? '') ?>">
                    </div>
                    <div class="field">
                        <label>Profile Link</label>
                        <input type="text" class="chairman-input" data-key="link" value="<?= esc($chairman['link'] ?? '') ?>">
                    </div>
                    <div class="field">
                        <label>Photo</label>
                        <input type="file" class="image-uploader" data-target="chairman-img">
                        <input type="hidden" class="chairman-input" data-key="image" id="chairman-img" value="<?= esc($chairman['image'] ?? '') ?>">
                        <img src="<?= esc($chairman['image'] ?? '') ?>" id="chairman-img-preview" class="preview-img" style="<?= empty($chairman['image']) ? 'display:none' : '' ?>">
                    </div>
                </div>
            </div>
        <?php elseif ($section['section_key'] === 'hotline'): ?>
            <?php $hotline = json_decode($section['content'], true); ?>
            <div class="field">
                <label>Hotline Configuration</label>
                <div class="widget-editor-container" id="hotline-editor">
                    <div class="field">
                        <label>Destination URL</label>
                        <input type="text" class="hotline-input" data-key="url" value="<?= esc($hotline['url'] ?? '') ?>">
                    </div>
                    <div class="field">
                        <label>Hotline Image/Banner</label>
                        <input type="file" class="image-uploader" data-target="hotline-img">
                        <input type="hidden" class="hotline-input" data-key="image" id="hotline-img" value="<?= esc($hotline['image'] ?? '') ?>">
                        <img src="<?= esc($hotline['image'] ?? '') ?>" id="hotline-img-preview" class="preview-img" style="<?= empty($hotline['image']) ? 'display:none' : '' ?>">
                    </div>
                </div>
            </div>
        <?php elseif ($section['section_key'] === 'important_links'): ?>
            <?php $links = json_decode($section['content'], true) ?? []; ?>
            <div class="field">
                <label>Important Links</label>
                <div class="widget-editor-container">
                    <div id="links-list">
                        <?php foreach ($links as $link): ?>
                        <div class="link-item">
                            <input type="text" placeholder="Label" class="link-label" value="<?= esc($link['label'] ?? '') ?>" style="flex: 1;">
                            <input type="text" placeholder="URL" class="link-url" value="<?= esc($link['url'] ?? '') ?>" style="flex: 2;">
                            <span class="btn-remove">&times;</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="btn-add" id="add-link"><span>+</span> Add Link</div>
                </div>
            </div>
        <?php else: ?>
            <div class="field">
                <label>JSON Data Structure</label>
                <p class="subtle">This section uses a structured data format. Edit with care.</p>
                <textarea name="raw_json_content" id="raw-json-textarea" rows="20" style="font-family: monospace;"><?= esc($section['content']) ?></textarea>
            </div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" class="btn">Save Changes</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script src="https://unpkg.com/grapesjs"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionKey = '<?= $section['section_key'] ?>';
    const sectionType = '<?= $section['type'] ?>';
    const form = document.getElementById('section-form');

    // 1. GrapesJS Initialization (if applicable)
    if (sectionType === 'html') {
        const editor = grapesjs.init({
            container: '#gjs',
            fromElement: false,
            height: '600px',
            storageManager: false,
            blockManager: {
                blocks: [
                    {
                        id: 'section',
                        label: '<b>Section</b>',
                        content: `<section style="padding: 20px; font-family: sans-serif;">
                            <h2 style="color: #102841;">New Title</h2>
                            <p>Enter your content here...</p>
                        </section>`,
                    }, {
                        id: 'text',
                        label: 'Text',
                        content: '<div data-gjs-type="text" style="padding: 10px;">Insert your text here</div>',
                    }, {
                        id: 'image',
                        label: 'Image',
                        content: { type: 'image' },
                    }, {
                        id: 'button',
                        label: 'Button',
                        content: '<a href="#" style="display: inline-block; background: #0b6bcb; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Click Me</a>',
                    }, {
                        id: 'divider',
                        label: 'Divider',
                        content: '<hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">',
                    }
                ]
            },
            assetManager: {
                upload: '/admin/upload-image',
                assets: [
                   'https://bemb.sukhandighidm.edu.bd/site-assets/images/logo.png',
                ],
            }
        });
        
        const initialContent = <?= json_encode($section['content'] ?? '') ?>;
        editor.setComponents(initialContent);

        form.addEventListener('submit', function() {
            document.getElementById('html-content').value = editor.getHtml() + '<style>' + editor.getCss() + '</style>';
        });
    }

    // 2. Image Upload Handling
    document.querySelectorAll('.image-uploader').forEach(input => {
        input.addEventListener('change', async function() {
            const file = this.files[0];
            if (!file) return;

            const targetId = this.dataset.target;
            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await fetch('/admin/upload-image', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                
                if (result.location) {
                    document.getElementById(targetId).value = result.location;
                    document.getElementById(targetId + '-preview').src = result.location;
                    document.getElementById(targetId + '-preview').style.display = 'block';
                } else {
                    alert('Upload failed: ' + (result.error || 'Unknown error'));
                }
            } catch (err) {
                console.error(err);
                alert('Error uploading image');
            }
        });
    });

    // 3. Important Links Handling
    const addLinkBtn = document.getElementById('add-link');
    if (addLinkBtn) {
        addLinkBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'link-item';
            div.innerHTML = `
                <input type="text" placeholder="Label" class="link-label" style="flex: 1;">
                <input type="text" placeholder="URL" class="link-url" style="flex: 2;">
                <span class="btn-remove">&times;</span>
            `;
            document.getElementById('links-list').appendChild(div);
        });

        document.getElementById('links-list').addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-remove')) {
                e.target.parentElement.remove();
            }
        });
    }

    // 4. Form Submission - Prepare JSON
    form.addEventListener('submit', function(e) {
        let content = '';

        if (sectionKey === 'chairman') {
            const data = {};
            document.querySelectorAll('.chairman-input').forEach(input => {
                data[input.dataset.key] = input.value;
            });
            content = JSON.stringify(data);
        } else if (sectionKey === 'hotline') {
            const data = {};
            document.querySelectorAll('.hotline-input').forEach(input => {
                data[input.dataset.key] = input.value;
            });
            content = JSON.stringify(data);
        } else if (sectionKey === 'important_links') {
            const data = [];
            document.querySelectorAll('.link-item').forEach(item => {
                data.push({
                    label: item.querySelector('.link-label').value,
                    url: item.querySelector('.link-url').value
                });
            });
            content = JSON.stringify(data);
        } else if (document.getElementById('raw-json-textarea')) {
            content = document.getElementById('raw-json-textarea').value;
        }

        if (content) {
            document.getElementById('json-content-hidden').value = content;
        }
    });
});
</script>
<?= $this->endSection() ?>
