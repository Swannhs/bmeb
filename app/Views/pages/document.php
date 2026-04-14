<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= $title ?> | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    <div class="content-browse-widget widget">
        <div class="title-bar">
            <div>
                <h2><?= $title ?></h2>
            </div>
        </div>
        
        <div class="body-content">
            <div class="mirrored-content">
                <?= $content ?>
            </div>
        </div>

        <div class="social-share-block">
            <section data-widget_type="widget" data-widget_name="SocialContentShareWidget" class="widget social-content-share-widget">
                <div>
                    <p class="social-content-share-widget-title">এই কনটেন্টটি শেয়ার করতে ক্লিক করুন</p>
                    <div class="social-content-share-widget-social-icons">
                        <a title="Facebook" class="social-content-share-widget-social-icons-link facebook-share" target="_blank" rel="noopener">
                            <i class="ph-fill ph-facebook-logo social-content-share-widget-fb-icon"></i>
                        </a>
                        <a title="X (Formerly Twitter)" class="social-content-share-widget-social-icons-link twitter-share" target="_blank" rel="noopener">
                            <i class="ph ph-x-logo social-content-share-widget-twitter-icon"></i>
                        </a>
                        <a title="WhatsApp" class="social-content-share-widget-social-icons-link whatsapp-share" target="_blank" rel="noopener">
                            <i class="ph-fill ph-whatsapp-logo social-content-share-widget-whatsapp-icon"></i>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
