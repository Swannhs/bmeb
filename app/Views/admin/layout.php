<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin Panel') ?></title>
    <style>
        :root { color-scheme: light; --bg:#f6f8fb; --panel:#fff; --border:#d6dde8; --text:#16324f; --muted:#5d7188; --brand:#0b6bcb; --brand-dark:#084f97; --danger:#c03f3f; --success:#227a4d; }
        * { box-sizing:border-box; }
        body { margin:0; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; background:var(--bg); color:var(--text); }
        a { color:var(--brand); text-decoration:none; }
        .shell { display:grid; grid-template-columns:240px 1fr; min-height:100vh; }
        .sidebar { background:#102841; color:#fff; padding:24px; }
        .sidebar h1 { font-size:20px; margin:0 0 24px; }
        .sidebar a { display:block; color:#d9e7f7; padding:10px 12px; border-radius:10px; margin-bottom:6px; }
        .sidebar a:hover, .sidebar a.active { background:rgba(255,255,255,0.1); color:#fff; }
        .main { padding:28px; }
        .panel { background:var(--panel); border:1px solid var(--border); border-radius:18px; box-shadow:0 8px 30px rgba(16,40,65,0.05); }
        .panel-pad { padding:24px; }
        .header { display:flex; justify-content:space-between; align-items:center; gap:16px; margin-bottom:24px; }
        .header h2 { margin:0; font-size:28px; }
        .subtle { color:var(--muted); }
        .grid { display:grid; gap:16px; }
        .grid.cols-4 { grid-template-columns:repeat(4, minmax(0,1fr)); }
        .grid.cols-2 { grid-template-columns:repeat(2, minmax(0,1fr)); }
        .stat { padding:20px; }
        .stat strong { display:block; font-size:30px; margin-top:8px; }
        .toolbar { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; }
        .btn, button { appearance:none; border:none; border-radius:12px; padding:10px 16px; background:var(--brand); color:#fff; font-weight:600; cursor:pointer; }
        .btn:hover, button:hover { background:var(--brand-dark); }
        .btn.secondary { background:#eef4fb; color:var(--text); border:1px solid var(--border); }
        .btn.danger { background:var(--danger); }
        form.inline { display:inline; }
        input, select, textarea { width:100%; border:1px solid var(--border); border-radius:12px; padding:12px 14px; font:inherit; background:#fff; color:var(--text); }
        textarea { min-height:440px; resize:vertical; }
        label { display:block; font-weight:600; margin-bottom:8px; }
        .field { margin-bottom:18px; }
        .hint, .error { margin-top:6px; font-size:14px; }
        .hint { color:var(--muted); }
        .error { color:var(--danger); }
        .flash { padding:14px 16px; border-radius:12px; margin-bottom:16px; }
        .flash.success { background:#e8f7ef; color:var(--success); border:1px solid #c9e9d7; }
        .flash.error { background:#fff0f0; color:var(--danger); border:1px solid #f0d1d1; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:14px 12px; border-bottom:1px solid var(--border); text-align:left; vertical-align:top; }
        th { font-size:13px; text-transform:uppercase; letter-spacing:.04em; color:var(--muted); }
        .table-actions { display:flex; gap:8px; flex-wrap:wrap; }
        .pill { display:inline-block; padding:5px 10px; border-radius:999px; background:#eef4fb; color:var(--text); font-size:13px; }
        .auth-wrap { max-width:460px; margin:8vh auto; }
        .auth-brand { margin-bottom:18px; text-align:center; }
        .auth-brand h1 { margin:0 0 6px; }
        .pagination { margin-top:20px; }
        @media (max-width: 980px) {
            .shell { grid-template-columns:1fr; }
            .grid.cols-4, .grid.cols-2 { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
<?php if (($authless ?? false) === true): ?>
    <?= $this->renderSection('content') ?>
<?php else: ?>
    <div class="shell">
        <aside class="sidebar">
            <h1>BMEB Admin</h1>
            <a href="/admin" class="<?= current_url(true)->getPath() === 'admin' ? 'active' : '' ?>">Dashboard</a>
            <a href="/admin/pages" class="<?= str_starts_with(current_url(true)->getPath(), 'admin/pages') ? 'active' : '' ?>">Pages</a>
            <a href="/admin/notices" class="<?= str_starts_with(current_url(true)->getPath(), 'admin/notices') ? 'active' : '' ?>">Notices</a>
            <a href="/admin/officers" class="<?= str_starts_with(current_url(true)->getPath(), 'admin/officers') ? 'active' : '' ?>">Officers</a>
            <a href="/" target="_blank" rel="noreferrer">Open Website</a>
            <a href="/admin/logout">Logout</a>
        </aside>
        <main class="main">
            <?php if (session()->getFlashdata('message')): ?>
                <div class="flash success"><?= esc((string) session()->getFlashdata('message')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="flash error"><?= esc((string) session()->getFlashdata('error')) ?></div>
            <?php endif; ?>
            <?= $this->renderSection('content') ?>
        </main>
    </div>
<?php endif; ?>
</body>
</html>
