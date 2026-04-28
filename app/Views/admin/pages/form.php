<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><?= $page === null ? 'Create Page' : 'Edit Page' ?></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/admin/pages" class="text-decoration-none">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $page === null ? 'Create' : 'Edit' ?></li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <?php if ($page !== null): ?>
            <a class="btn btn-warning text-dark fw-semibold" href="/admin/pages/<?= $page['id'] ?>/builder"><i class="ph ph-paint-brush me-1"></i> Launch Visual Builder</a>
        <?php endif; ?>
        <a href="/admin/pages" class="btn btn-outline-secondary"><i class="ph ph-arrow-left me-1"></i> Back</a>
    </div>
</div>

<div class="card shadow-sm" style="max-width: 900px;">
    <div class="card-body p-4">
        <form method="post" action="<?= $page === null ? '/admin/pages' : '/admin/pages/' . $page['id'] ?>">
            
            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" id="title" name="title" class="form-control form-control-lg" required value="<?= esc((string) old('title', $page['title'] ?? '')) ?>">
                    <?php if (isset($errors['title'])): ?><div class="text-danger small mt-1"><?= esc($errors['title']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select id="status" name="status" class="form-select form-select-lg">
                        <?php $status = (string) old('status', $page['status'] ?? 'published'); ?>
                        <option value="published" <?= $status === 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= $status === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                    <?php if (isset($errors['status'])): ?><div class="text-danger small mt-1"><?= esc($errors['status']) ?></div><?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="route_key" class="form-label fw-semibold">Route Key (Legacy)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="ph ph-link"></i></span>
                        <input type="text" id="route_key" name="route_key" class="form-control" value="<?= esc((string) old('route_key', $page['route_key'] ?? '')) ?>" placeholder="/pages/notices">
                    </div>
                    <div class="form-text">Examples: `/`, `/pages/notices`</div>
                    <?php if (isset($errors['route_key'])): ?><div class="text-danger small mt-1"><?= esc($errors['route_key']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="slug" class="form-label fw-semibold">URL Slug (SEO Friendly)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">/p/</span>
                        <input type="text" id="slug" name="slug" class="form-control" value="<?= esc((string) old('slug', $page['slug'] ?? '')) ?>" placeholder="my-page-title">
                    </div>
                    <div class="form-text">Leave blank to auto-generate from title.</div>
                    <?php if (isset($errors['slug'])): ?><div class="text-danger small mt-1"><?= esc($errors['slug']) ?></div><?php endif; ?>
                </div>
            </div>

            <div class="mb-4">
                <label for="source_path" class="form-label fw-semibold">Source Path</label>
                <input type="text" id="source_path" name="source_path" class="form-control" value="<?= esc((string) old('source_path', $page['source_path'] ?? '')) ?>" placeholder="public/pages/notices.html">
            </div>

            <div class="mb-4">
                <label for="html_content" class="form-label fw-semibold">Page Content (EditorJS)</label>
                <div class="mb-2">
                    <?= $this->include('admin/pages/builder_toolbox') ?>
                </div>
                <div id="editorjs" class="editorjs-container shadow-sm border rounded"></div>
                <textarea id="html_content" name="html_content" style="display:none;"><?= esc((string) old('html_content', $page['html_content'] ?? '')) ?></textarea>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const contentArea = document.getElementById('html_content');
                    let initialData = {};
                    
                    try {
                        initialData = JSON.parse(contentArea.value);
                    } catch (e) {
                        if (contentArea.value.trim() !== '') {
                            initialData = {
                                blocks: [{ type: 'paragraph', data: { text: contentArea.value } }]
                            };
                        }
                    }

                    const editor = new EditorJS({
                        holder: 'editorjs',
                        tools: {
                            header: window.Header || null,
                            list: window.EditorjsList || window.List || null,
                            image: {
                                class: window.ImageTool || null,
                                config: { endpoints: { byFile: '/admin/upload-image' } }
                            },
                            table: window.Table || null,
                            delimiter: window.Delimiter || null,
                            quote: window.Quote || null,
                        },
                        data: initialData,
                        placeholder: 'Write your page content here...',
                        onChange: () => {
                            editor.save().then((outputData) => {
                                contentArea.value = JSON.stringify(outputData);
                            });
                        }
                    });

                    contentArea.form.addEventListener('submit', function(e) {
                        editor.save().then((outputData) => {
                            contentArea.value = JSON.stringify(outputData);
                        });
                    });
                });
            </script>

            <div class="d-flex gap-2 border-top pt-4 mt-2">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="ph ph-floppy-disk me-2"></i>Save Page</button>
                <?php if ($page !== null): ?>
                    <a class="btn btn-outline-info px-4 py-2" target="_blank" rel="noreferrer" href="/p/<?= esc($page['slug'] ?: $page['route_key']) ?>"><i class="ph ph-eye me-2"></i>Preview</a>
                <?php endif; ?>
                <a href="/admin/pages" class="btn btn-light border px-4 py-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
