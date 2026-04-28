<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visual Builder - <?= esc($page['title']) ?></title>
    
    <!-- GrapesJS Core -->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>
    
    <!-- GrapesJS Plugins -->
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms"></script>
    <script src="https://unpkg.com/grapesjs-component-countdown"></script>
    
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <style>
        :root {
            --primary-bg: #1e293b;
            --accent-color: #38bdf8;
            --text-light: #f8fafc;
        }
        body, html { height: 100%; margin: 0; font-family: 'Inter', sans-serif; overflow: hidden; background: #0f172a; }
        
        /* Premium Topbar */
        .builder-topbar {
            background: #0f172a;
            color: #fff;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            z-index: 10;
        }
        .builder-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--accent-color);
        }
        .builder-logo span { color: #fff; font-weight: 500; font-size: 0.9rem; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.2); padding-left: 15px; }
        
        .device-toggles {
            display: flex;
            background: rgba(255,255,255,0.05);
            padding: 4px;
            border-radius: 8px;
        }
        .device-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .device-btn:hover { color: #fff; }
        .device-btn.active { background: var(--accent-color); color: #000; }
        
        .builder-actions { display: flex; gap: 12px; }
        .btn {
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 13.5px;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .btn-exit { background: transparent; color: #94a3b8; border: 1px solid rgba(255,255,255,0.1); }
        .btn-exit:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .btn-publish { background: var(--accent-color); color: #0f172a; box-shadow: 0 0 15px rgba(56, 189, 248, 0.3); }
        .btn-publish:hover { transform: translateY(-1px); box-shadow: 0 5px 20px rgba(56, 189, 248, 0.4); }
        
        #gjs { height: calc(100% - 60px) !important; }
        
        /* GrapesJS UI Overrides */
        .gjs-one-bg { background-color: #1e293b !important; }
        .gjs-two-color { color: #cbd5e1 !important; }
        .gjs-three-bg { background-color: var(--accent-color) !important; }
        .gjs-four-color, .gjs-four-color-h:hover { color: var(--accent-color) !important; }
        
        .gjs-cv-canvas { background-color: #f1f5f9 !important; }
        .gjs-block {
            width: 45%;
            margin: 2.5%;
            background-color: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 8px;
            padding: 15px 5px;
            transition: all 0.2s;
        }
        .gjs-block:hover { border-color: var(--accent-color); color: var(--accent-color); }
        .gjs-block-label { font-size: 0.75rem; margin-top: 8px; }
        
        /* Toast Notification */
        #toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: #10b981;
            color: #fff;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            display: none;
            z-index: 1000;
        }
    </style>
</head>
<body>

<div class="builder-topbar">
    <div class="builder-logo">
        <i class="ph ph-lightning-fill"></i> BMEB Builder
        <span>Editing: <?= esc($page['title']) ?></span>
    </div>
    
    <div class="device-toggles">
        <button class="device-btn active" data-device="desktop" title="Desktop View">
            <i class="ph ph-desktop fs-5"></i>
        </button>
        <button class="device-btn" data-device="tablet" title="Tablet View">
            <i class="ph ph-tablet fs-5"></i>
        </button>
        <button class="device-btn" data-device="mobile" title="Mobile View">
            <i class="ph ph-phone fs-5"></i>
        </button>
    </div>
    
    <div class="builder-actions">
        <button class="btn btn-exit" onclick="window.location.href='/admin/pages'">
            <i class="ph ph-x"></i> Exit
        </button>
        <button class="btn btn-publish" id="save-btn">
            <i class="ph ph-rocket-launch"></i> Publish Changes
        </button>
    </div>
</div>

<div id="gjs"></div>
<div id="toast">Saved Successfully!</div>

<script>
    const editor = grapesjs.init({
        container: '#gjs',
        height: '100%',
        fromElement: false,
        storageManager: false,
        allowScripts: 1,
        plugins: [
            'gjs-preset-webpage',
            'gjs-blocks-basic',
            'grapesjs-plugin-forms',
            'grapesjs-component-countdown'
        ],
        pluginsOpts: {
            'gjs-preset-webpage': {
                modalImportTitle: 'Import HTML',
                modalImportLabel: '<div style="margin-bottom: 10px">Paste your HTML/CSS here:</div>',
                modalImportContent: function(editor) {
                    return editor.getHtml() + '<style>' + editor.getCss() + '</style>';
                },
            }
        },
        canvas: {
            styles: [
                'https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap',
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'
            ]
        },
        assetManager: {
            assets: [
                'https://bemb.sukhandighidm.edu.bd/site-assets/images/logo.png',
                'https://bemb.sukhandighidm.edu.bd/site-assets/images/placeholder.png'
            ],
            upload: '/admin/upload-image',
            uploadName: 'image',
        },
        deviceManager: {
            devices: [
                { name: 'desktop', width: '' },
                { name: 'tablet', width: '768px', widthMedia: '992px' },
                { name: 'mobile', width: '375px', widthMedia: '480px' }
            ]
        }
    });

    // Device Switcher Logic
    document.querySelectorAll('.device-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const device = btn.getAttribute('data-device');
            editor.setDevice(device);
            document.querySelectorAll('.device-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Add Custom BMEB Styled Blocks
    const blockManager = editor.BlockManager;
    
    blockManager.add('bmeb-hero', {
        label: 'Board Hero',
        category: 'BMEB Sections',
        content: `
            <section style="padding: 120px 20px; background: #102841; color: white; text-align: center;">
                <div style="max-width: 800px; margin: 0 auto;">
                    <h1 style="font-size: 3.5rem; margin-bottom: 20px; font-weight: 700;">Bangladesh Madrasah Education Board</h1>
                    <p style="font-size: 1.25rem; opacity: 0.8; margin-bottom: 40px;">Ensuring quality education and excellence in Madrasah board management.</p>
                    <a href="#" style="background: #38bdf8; color: #102841; padding: 16px 32px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1.1rem;">Explore Board Services</a>
                </div>
            </section>
        `
    });

    blockManager.add('bmeb-info-card', {
        label: 'Info Card',
        category: 'BMEB Sections',
        content: `
            <div style="padding: 30px; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h3 style="color: #1e293b; margin-top: 0;">Card Title</h3>
                <p style="color: #64748b; line-height: 1.6;">Add your informative content here. You can customize the look using the Style Manager on the right.</p>
                <a href="#" style="color: #38bdf8; font-weight: 600; text-decoration: none;">Read More &rarr;</a>
            </div>
        `
    });

    // Load Existing Content
    const initialHtml = <?= json_encode($page['html_content'] ?? '') ?>;
    if (initialHtml) {
        editor.setComponents(initialHtml);
    }

    // Save Logic
    document.getElementById('save-btn').addEventListener('click', () => {
        const htmlContent = editor.getHtml() + '<style>' + editor.getCss() + '</style>';
        const btn = document.getElementById('save-btn');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<i class="ph ph-circle-notch ph-spin"></i> Publishing...';
        
        fetch('/admin/pages/<?= $page['id'] ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new URLSearchParams({
                'title': '<?= esc($page['title']) ?>',
                'route_key': '<?= esc($page['route_key']) ?>',
                'status': '<?= esc($page['status']) ?>',
                'html_content': htmlContent
            })
        })
        .then(response => {
            if (response.ok) {
                const toast = document.getElementById('toast');
                toast.style.display = 'block';
                setTimeout(() => {
                    window.location.href = '/admin/pages';
                }, 1500);
            } else {
                alert('Error saving page.');
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    });

    // Show Blocks by default
    editor.on('load', () => {
        const openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
        openBlocksBtn && openBlocksBtn.set('active', 1);
    });
</script>

</body>
</html>

