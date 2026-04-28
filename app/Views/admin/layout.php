<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin Management System') ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- EditorJS Core & Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    
    <!-- SortableJS for Drag & Drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    
    <style>
        :root {
            --sidebar-width: 260px;
            --brand-color: #0b6bcb;
            --brand-dark: #084f97;
            --bg-light: #f8f9fa;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: #333;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: #1e293b;
            color: #fff;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-category {
            padding: 15px 20px 5px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            font-weight: 600;
        }
        .sidebar-nav {
            padding: 10px 0;
            margin: 0;
            list-style: none;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-nav a i {
            margin-right: 12px;
            font-size: 1.25rem;
        }
        .sidebar-nav a:hover {
            background-color: rgba(255,255,255,0.05);
            color: #fff;
        }
        .sidebar-nav a.active {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            border-left-color: #38bdf8;
        }
        
        /* Main Content Styles */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            height: 70px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .content-area {
            padding: 30px;
            flex: 1;
        }
        
        /* Card & UI Overrides */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-bottom: 24px;
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 16px 24px;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }
        .btn-primary {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
        }
        .btn-primary:hover {
            background-color: var(--brand-dark);
            border-color: var(--brand-dark);
        }
        .table th {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 600;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }
        .table td {
            vertical-align: middle;
            color: #475569;
        }
        
        /* EditorJS Container Overrides */
        .editorjs-container {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            min-height: 400px;
        }
        
        /* Utilities */
        .rounded-pill-badge {
            font-size: 0.75rem;
            padding: 4px 10px;
            font-weight: 500;
        }
    </style>
    <?= $this->renderSection('extra-css') ?>
</head>
<body>
<?php if (($authless ?? false) === true): ?>
    <div class="container mt-5">
        <?= $this->renderSection('content') ?>
    </div>
<?php else: ?>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4><i class="ph ph-shield-check text-info"></i> BMEB CMS</h4>
        </div>
        
        <ul class="sidebar-nav">
            <li class="nav-category">Overview</li>
            <li>
                <a href="<?= base_url('admin') ?>" class="<?= uri_string() === 'admin' ? 'active' : '' ?>">
                    <i class="ph ph-squares-four"></i> Dashboard
                </a>
            </li>
            
            <li class="nav-category">Content</li>
            <li>
                <a href="<?= base_url('admin/pages') ?>" class="<?= str_starts_with(uri_string(), 'admin/pages') ? 'active' : '' ?>">
                    <i class="ph ph-files"></i> Pages
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/notices') ?>" class="<?= str_starts_with(uri_string(), 'admin/notices') ? 'active' : '' ?>">
                    <i class="ph ph-megaphone"></i> Notices
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/media') ?>" class="<?= str_starts_with(uri_string(), 'admin/media') ? 'active' : '' ?>">
                    <i class="ph ph-images-square"></i> Media Library
                </a>
            </li>
            
            <li class="nav-category">Website Builder</li>
            <li>
                <a href="<?= base_url('admin/home-sections') ?>" class="<?= str_starts_with(uri_string(), 'admin/home-sections') ? 'active' : '' ?>">
                    <i class="ph ph-layout"></i> Home Sections
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/sliders') ?>" class="<?= str_starts_with(uri_string(), 'admin/sliders') ? 'active' : '' ?>">
                    <i class="ph ph-images"></i> Sliders
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/menus') ?>" class="<?= str_starts_with(uri_string(), 'admin/menus') ? 'active' : '' ?>">
                    <i class="ph ph-list-dashes"></i> Menus
                </a>
            </li>
            
            <li class="nav-category">Directory</li>
            <li>
                <a href="<?= base_url('admin/officers') ?>" class="<?= str_starts_with(uri_string(), 'admin/officers') ? 'active' : '' ?>">
                    <i class="ph ph-users"></i> Officers
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-muted d-none d-md-block"><?= esc($title ?? 'Admin Dashboard') ?></h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="<?= base_url() ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="ph ph-arrow-square-out me-1"></i> View Live Site
                </a>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none text-dark" id="userDropdown" data-bs-toggle="dropdown">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-weight: 600;">
                            A
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li><a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>"><i class="ph ph-sign-out me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
<?php endif; ?>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- Global Toast Notifications -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (session()->getFlashdata('message') || session()->getFlashdata('success')): ?>
            Toastify({
                text: "<?= esc(session()->getFlashdata('message') ?? session()->getFlashdata('success')) ?>",
                duration: 4000,
                close: true,
                gravity: "top", 
                position: "right",
                style: { background: "#10b981", borderRadius: "8px", boxShadow: "0 4px 12px rgba(0,0,0,0.1)" }
            }).showToast();
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Toastify({
                text: "<?= esc(session()->getFlashdata('error')) ?>",
                duration: 5000,
                close: true,
                gravity: "top", 
                position: "right",
                style: { background: "#ef4444", borderRadius: "8px", boxShadow: "0 4px 12px rgba(0,0,0,0.1)" }
            }).showToast();
        <?php endif; ?>
    });
</script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            "pageLength": 25,
            "language": {
                "search": "",
                "searchPlaceholder": "Search records..."
            }
        });
        
        // SweetAlert2 Delete Confirmation
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const url = $(this).attr('href') || $(this).data('url');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if($(this).is('a')) {
                        window.location.href = url;
                    } else {
                        // If it's a form button
                        $(this).closest('form').submit();
                    }
                }
            })
        });
    });
</script>

<?= $this->renderSection('extra-js') ?>
</body>
</html>
