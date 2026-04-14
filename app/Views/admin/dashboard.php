<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2>Dashboard</h2>
        <p class="subtle">Manage the dynamic BMEB content and admin access.</p>
    </div>
    <a class="btn" href="/admin/pages">Manage Pages</a>
</div>

<div class="grid cols-4">
    <div class="panel stat"><span class="subtle">Total Pages</span><strong><?= esc((string) $totalPages) ?></strong></div>
    <div class="panel stat"><span class="subtle">Published</span><strong><?= esc((string) $publishedPages) ?></strong></div>
    <div class="panel stat"><span class="subtle">Drafts</span><strong><?= esc((string) $draftPages) ?></strong></div>
    <div class="panel stat"><span class="subtle">Admins</span><strong><?= esc((string) $totalAdmins) ?></strong></div>
</div>

<div class="panel panel-pad" style="margin-top:20px;">
    <h3 style="margin-top:0;">What’s Ready</h3>
    <p class="subtle">The public site now checks the CMS database first. That means any page you edit here will override the mirrored file and appear immediately on the frontend.</p>
    <div class="toolbar" style="margin-top:16px;">
        <a class="btn" href="/admin/pages/new">Create New Page</a>
        <form class="inline" method="post" action="/admin/pages/import">
            <button type="submit" class="btn secondary">Import Missing Mirror Pages</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
