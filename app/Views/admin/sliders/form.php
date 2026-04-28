<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $slider['id'] ? 'Edit Slider' : 'Add New Slider' ?></h2>
    <a href="<?= base_url('admin/sliders') ?>" class="btn btn-secondary">Back to Sliders</a>
</div>

<div class="card" style="max-width: 800px;">
    <div class="card-body">
        <form method="post" action="<?= $slider['id'] ? base_url("admin/sliders/edit/{$slider['id']}") : base_url("admin/sliders/create") ?>">
            
            <div class="mb-3">
                <label for="image_url" class="form-label fw-semibold">Image URL <span class="text-danger">*</span></label>
                <div class="input-group mb-2">
                    <span class="input-group-text bg-light"><i class="ph ph-link"></i></span>
                    <input type="text" class="form-control" id="image_url" name="image_url" required value="<?= esc(old('image_url', $slider['image_url'])) ?>">
                    <button class="btn btn-outline-primary" type="button" id="mediaLibraryBtn"><i class="ph ph-images"></i> Media Library</button>
                    <button class="btn btn-outline-secondary" type="button" id="uploadBtn"><i class="ph ph-upload-simple"></i> Upload</button>
                </div>
                <div class="form-text">Enter a URL, select from the library, or upload a new image.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Preview</label>
                <div class="border rounded p-2 bg-light d-flex align-items-center justify-content-center" style="min-height: 200px;">
                    <img id="image_preview" src="<?= esc($slider['image_url']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 300px; <?= empty($slider['image_url']) ? 'display: none;' : '' ?>">
                    <div id="preview_placeholder" class="text-muted small" style="<?= !empty($slider['image_url']) ? 'display: none;' : '' ?>">No image selected</div>
                </div>
            </div>

            <div class="d-flex gap-2 border-top pt-4">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="ph ph-floppy-disk me-2"></i><?= $slider['id'] ? 'Save Changes' : 'Add Slider' ?></button>
                <a href="<?= base_url('admin/sliders') ?>" class="btn btn-light border px-4 py-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Media Picker Modal -->
<div class="modal fade" id="mediaPickerModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Select Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="picker-search" class="form-control bg-light" placeholder="Search images...">
                </div>
                <div id="picker-grid" class="row g-3" style="max-height: 500px; overflow-y: auto;">
                    <!-- Images loaded via JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<input type="file" id="fileInput" accept="image/*" style="display: none;">

<style>
    .picker-item { cursor: pointer; transition: all 0.2s; }
    .picker-item:hover { transform: scale(1.05); }
    .picker-thumb { aspect-ratio: 16/9; object-fit: cover; border-radius: 8px; width: 100%; border: 2px solid transparent; }
    .picker-item:hover .picker-thumb { border-color: #38bdf8; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadBtn = document.getElementById('uploadBtn');
    const mediaLibraryBtn = document.getElementById('mediaLibraryBtn');
    const fileInput = document.getElementById('fileInput');
    const imageUrlInput = document.getElementById('image_url');
    const imagePreview = document.getElementById('image_preview');
    const previewPlaceholder = document.getElementById('preview_placeholder');
    const mediaPickerModal = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
    const pickerGrid = document.getElementById('picker-grid');
    const pickerSearch = document.getElementById('picker-search');

    uploadBtn.addEventListener('click', () => fileInput.click());

    mediaLibraryBtn.addEventListener('click', async () => {
        mediaPickerModal.show();
        pickerGrid.innerHTML = '<div class="col-12 text-center py-5 text-muted">Loading...</div>';
        
        try {
            const response = await fetch('<?= base_url('admin/media/list') ?>');
            const data = await response.json();
            renderPicker(data);
        } catch (error) {
            pickerGrid.innerHTML = '<div class="col-12 text-center text-danger">Error loading media.</div>';
        }
    });

    function renderPicker(items) {
        pickerGrid.innerHTML = items.map(item => `
            <div class="col-6 col-md-4 col-lg-3 picker-item-wrap" data-name="${item.name.toLowerCase()}">
                <div class="picker-item" onclick="selectImage('${item.url}')">
                    <img src="${item.url}" class="picker-thumb shadow-sm">
                    <div class="small text-muted text-truncate mt-1 text-center">${item.name}</div>
                </div>
            </div>
        `).join('');
    }

    window.selectImage = (url) => {
        imageUrlInput.value = url;
        updatePreview(url);
        mediaPickerModal.hide();
    };

    pickerSearch.addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.picker-item-wrap').forEach(item => {
            item.style.display = item.getAttribute('data-name').includes(term) ? 'block' : 'none';
        });
    });

    fileInput.addEventListener('change', async function() {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('file', this.files[0]);
            
            uploadBtn.innerHTML = '<i class="ph ph-circle-notch ph-spin"></i> Uploading...';
            uploadBtn.disabled = true;

            try {
                const response = await fetch('<?= base_url('admin/upload-image') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (data.file && data.file.url) {
                    imageUrlInput.value = data.file.url;
                    updatePreview(data.file.url);
                    Toastify({ text: "Uploaded successfully!", style: { background: "#10b981" } }).showToast();
                }
            } catch (error) {
                alert('Upload failed.');
            } finally {
                uploadBtn.innerHTML = '<i class="ph ph-upload-simple"></i> Upload';
                uploadBtn.disabled = false;
            }
        }
    });

    function updatePreview(url) {
        if (url) {
            imagePreview.src = url;
            imagePreview.style.display = 'block';
            previewPlaceholder.style.display = 'none';
        } else {
            imagePreview.style.display = 'none';
            previewPlaceholder.style.display = 'block';
        }
    }

    imageUrlInput.addEventListener('input', function() {
        updatePreview(this.value);
    });
});
</script>
<?= $this->endSection() ?>
