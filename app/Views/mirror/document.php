<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= $document['title'] ?><?= $this->endSection() ?>

<?= $this->section('extra-css') ?>
    <?= $document['headContent'] ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="mirrored-content">
        <?= $document['mainContent'] ?>
    </div>
<?= $this->endSection() ?>
