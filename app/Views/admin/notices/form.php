<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><?= $notice['id'] ? 'Edit Notice' : 'New Notice' ?></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/admin/notices" class="text-decoration-none">Notices</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $notice['id'] ? 'Edit' : 'Create' ?></li>
            </ol>
        </nav>
    </div>
    <a href="/admin/notices" class="btn btn-outline-secondary"><i class="ph ph-arrow-left me-1"></i> Back</a>
</div>

<div class="card shadow-sm" style="max-width: 800px;">
    <div class="card-body p-4">
        <form method="post" action="<?= $notice['id'] ? "/admin/notices/{$notice['id']}" : "/admin/notices" ?>">
            
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" class="form-control form-control-lg" required value="<?= esc(old('title', $notice['title'])) ?>">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="slug" class="form-label fw-semibold">Slug (URL Snippet) <span class="text-danger">*</span></label>
                    <input type="text" id="slug" name="slug" class="form-control" required value="<?= esc(old('slug', $notice['slug'])) ?>">
                    <div class="form-text">Must be unique. Alphanumeric and dashes only.</div>
                </div>
                <div class="col-md-6">
                    <label for="category" class="form-label fw-semibold">Category</label>
                    <input type="text" id="category" name="category" class="form-control" value="<?= esc(old('category', $notice['category'])) ?>" placeholder="e.g. general, academic">
                </div>
            </div>

            <div class="mb-3">
                <label for="publish_date" class="form-label fw-semibold">Publish Date <span class="text-danger">*</span></label>
                <input type="date" id="publish_date" name="publish_date" class="form-control" style="max-width: 200px;" required value="<?= esc(old('publish_date', $notice['publish_date'] ? date('Y-m-d', strtotime($notice['publish_date'])) : date('Y-m-d'))) ?>">
            </div>

            <div class="mb-4">
                <label for="file_path" class="form-label fw-semibold">Attachment URL</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="ph ph-link"></i></span>
                    <input type="url" id="file_path" name="file_path" class="form-control" placeholder="https://..." value="<?= esc(old('file_path', $notice['file_path'])) ?>">
                </div>
                <div class="form-text">Optional direct link to a PDF or document.</div>
            </div>

            <div class="mb-4">
                <div class="form-check form-switch form-check-lg d-flex align-items-center gap-2">
                    <input type="hidden" name="is_new" value="0">
                    <input class="form-check-input mt-0" type="checkbox" role="switch" id="is_new" name="is_new" value="1" <?= old('is_new', $notice['is_new']) ? 'checked' : '' ?> style="transform: scale(1.3);">
                    <label class="form-check-label fw-medium ms-2 pt-1" for="is_new">Mark as "New" <span class="badge bg-danger ms-1">New</span></label>
                </div>
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-semibold">Description / Content</label>
                <div id="editorjs" class="editorjs-container shadow-sm"></div>
                <textarea id="content" name="content" style="display:none;"><?= esc(old('content', $notice['content'])) ?></textarea>
            </div>

            <div class="d-flex gap-2 border-top pt-4">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="ph ph-floppy-disk me-2"></i><?= $notice['id'] ? 'Save Changes' : 'Create Notice' ?></button>
                <a href="/admin/notices" class="btn btn-light border px-4 py-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contentArea = document.getElementById('content');
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
                    config: {
                        endpoints: {
                            byFile: '/admin/upload-image',
                        }
                    }
                },
                table: window.Table || null,
                linkTool: window.LinkTool || null,
                delimiter: window.Delimiter || null,
                quote: window.Quote || null,
            },
            data: initialData,
            placeholder: 'Let`s write an awesome notice!',
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
<?= $this->endSection() ?>
