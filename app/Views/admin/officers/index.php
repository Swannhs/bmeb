<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div>
        <h2>Officers</h2>
        <p class="subtle">Manage key officers contact directory.</p>
    </div>
    <div class="toolbar" style="margin-bottom:0;">
        <a class="btn" href="/admin/officers/new">New Officer</a>
    </div>
</div>

<div class="panel panel-pad">
    <?php if (session()->has('success')): ?>
        <div style="padding: 10px; background: #e6f4ea; color: #1e8e3e; margin-bottom: 15px; border-radius: 4px;">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div style="padding: 10px; background: #fce8e6; color: #d93025; margin-bottom: 15px; border-radius: 4px;">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
        <tr>
            <th>Order</th>
            <th>Photo</th>
            <th>Name & Desig.</th>
            <th>Contact</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($officers as $officer): ?>
            <tr>
                <td><?= esc($officer['sort_order']) ?></td>
                <td>
                    <?php if ($officer['photo_url']): ?>
                        <img src="<?= esc($officer['photo_url']) ?>" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" alt="">
                    <?php else: ?>
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: #eee;"></div>
                    <?php endif; ?>
                </td>
                <td>
                    <strong><?= esc($officer['name']) ?></strong><br>
                    <span class="subtle"><?= esc($officer['designation']) ?></span><br>
                    <span style="font-size: 13px; color: #666;"><?= esc($officer['office']) ?></span>
                </td>
                <td style="font-size: 14px;">
                    <div>E: <?= esc($officer['email']) ?></div>
                    <div>T: <?= esc($officer['phone_office']) ?></div>
                    <div class="subtle">M: <?= esc($officer['mobile']) ?></div>
                </td>
                <td>
                    <div class="table-actions">
                        <a class="btn secondary" href="/admin/officers/<?= esc((string) $officer['id']) ?>/edit">Edit</a>
                        <form class="inline" method="post" action="/admin/officers/<?= esc((string) $officer['id']) ?>/delete" onsubmit="return confirm('Delete this officer profile?');">
                            <button type="submit" class="btn danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($officers)): ?>
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;" class="subtle">No officers found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
