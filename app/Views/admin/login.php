<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="auth-wrap">
    <div class="auth-brand">
        <h1>BMEB Admin Login</h1>
        <p class="subtle">Sign in to manage the dynamic CodeIgniter content.</p>
    </div>
    <div class="panel panel-pad">
        <?php if (! empty($error)): ?>
            <div class="flash error"><?= esc((string) $error) ?></div>
        <?php endif; ?>
        <form method="post" action="/admin/login">
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= esc((string) old('email')) ?>" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p class="hint" style="margin-top:16px;">Default local login: `admin@bmeb.local` / `admin123456` unless you override the Docker env values.</p>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
