<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Media Library</h2>
        <p class="text-muted">Manage your uploaded images and assets.</p>
    </div>
    <div class="d-flex gap-2">
        <label for="media-upload-input" class="btn btn-primary">
            <i class="ph ph-upload-simple me-1"></i> Upload New
            <input type="file" id="media-upload-input" hidden accept="image/*" multiple>
        </label>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="input-group" style="max-width: 400px;">
            <span class="input-group-text bg-light border-end-0"><i class="ph ph-magnifying-glass text-muted"></i></span>
            <input type="text" id="media-search" class="form-control bg-light border-start-0" placeholder="Search by filename...">
        </div>
    </div>
    <div class="card-body p-4">
        <div id="media-grid" class="row g-4">
            <!-- Loading Spinner -->
            <div class="col-12 text-center py-5" id="media-loader">
                <div class="spinner-border text-primary" role="status"></div>
                <div class="mt-2 text-muted">Loading assets...</div>
            </div>
        </div>
    </div>
</div>

<!-- Image Detail Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-8 bg-light d-flex align-items-center justify-content-center p-4" style="min-height: 400px;">
                        <img id="modal-img" src="" class="img-fluid rounded shadow-sm" style="max-height: 500px;">
                    </div>
                    <div class="col-md-4 p-4 d-flex flex-column">
                        <h5 id="modal-filename" class="text-truncate fw-bold mb-3"></h5>
                        <div class="mb-4">
                            <label class="form-label text-muted small text-uppercase">Direct URL</label>
                            <div class="input-group mb-3">
                                <input type="text" id="modal-url" class="form-control form-control-sm" readonly>
                                <button class="btn btn-outline-primary btn-sm" id="btn-copy-url"><i class="ph ph-copy"></i></button>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <button type="button" class="btn btn-light w-100 mb-2 border" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .media-card {
        cursor: pointer;
        transition: all 0.2s;
        border: 1px solid transparent;
        height: 100%;
    }
    .media-card:hover {
        transform: translateY(-5px);
        border-color: #38bdf8;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .media-thumb-container {
        aspect-ratio: 1/1;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .media-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaGrid = document.getElementById('media-grid');
    const mediaSearch = document.getElementById('media-search');
    const uploadInput = document.getElementById('media-upload-input');
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    
    let allMedia = [];

    async function loadMedia() {
        try {
            const response = await fetch('<?= base_url('admin/media/list') ?>');
            allMedia = await response.json();
            renderMedia(allMedia);
        } catch (error) {
            console.error('Error loading media:', error);
            mediaGrid.innerHTML = '<div class="col-12 text-center text-danger">Failed to load media.</div>';
        }
    }

    function renderMedia(mediaItems) {
        if (mediaItems.length === 0) {
            mediaGrid.innerHTML = '<div class="col-12 text-center py-5 text-muted">No images found.</div>';
            return;
        }

        mediaGrid.innerHTML = mediaItems.map(item => `
            <div class="col-6 col-md-4 col-lg-2 media-item" data-name="${item.name.toLowerCase()}">
                <div class="media-card" onclick="showImage('${item.url}', '${item.name}')">
                    <div class="media-thumb-container">
                        <img src="${item.url}" class="media-thumb" loading="lazy">
                    </div>
                    <div class="mt-2 text-truncate small text-muted text-center px-1">${item.name}</div>
                </div>
            </div>
        `).join('');
    }

    window.showImage = (url, name) => {
        document.getElementById('modal-img').src = url;
        document.getElementById('modal-filename').textContent = name;
        document.getElementById('modal-url').value = url;
        imageModal.show();
    };

    document.getElementById('btn-copy-url').addEventListener('click', () => {
        const urlInput = document.getElementById('modal-url');
        urlInput.select();
        document.execCommand('copy');
        
        const btn = document.getElementById('btn-copy-url');
        const icon = btn.innerHTML;
        btn.innerHTML = '<i class="ph ph-check"></i>';
        btn.classList.replace('btn-outline-primary', 'btn-success');
        setTimeout(() => {
            btn.innerHTML = icon;
            btn.classList.replace('btn-success', 'btn-outline-primary');
        }, 2000);
    });

    mediaSearch.addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.media-item');
        items.forEach(item => {
            const name = item.getAttribute('data-name');
            item.style.display = name.includes(term) ? 'block' : 'none';
        });
    });

    uploadInput.addEventListener('change', async (e) => {
        const files = e.target.files;
        if (files.length === 0) return;

        for (const file of files) {
            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await fetch('<?= base_url('admin/upload-image') ?>', {
                    method: 'POST',
                    body: formData
                });
                
                if (response.ok) {
                    Toastify({
                        text: `Uploaded ${file.name} successfully!`,
                        duration: 3000,
                        style: { background: "#10b981" }
                    }).showToast();
                }
            } catch (error) {
                console.error('Upload error:', error);
            }
        }
        loadMedia(); // Reload grid
    });

    loadMedia();
});
</script>
<?= $this->endSection() ?>
