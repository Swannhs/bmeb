<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= $title ?> | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="wrapper">
    <div class="body">
        <div data-section_type="body" class="droppable">
            <!-- Social Share Widget -->
            <section data-widget_type="widget" data-widget_name="SocialContentShareWidget" class="widget social-content-share-widget">
                <div>
                    <p class="social-content-share-widget-title ">এই কনটেন্টটি শেয়ার করতে ক্লিক করুন</p>
                    <div class="social-content-share-widget-social-icons">
                        <a title="Facebook" class="social-content-share-widget-social-icons-link facebook-share" target="_blank" rel="noopener">
                            <i class="ph-fill ph-facebook-logo social-content-share-widget-fb-icon"></i>
                        </a>
                        <!-- ... other icons ... -->
                    </div>
                </div>
            </section>

            <!-- Main Content Viewer -->
            <div data-widget_type="widget" data-widget_name="ContentViewerWidget" class="widget content-view-widget"> 
                <div class="content-update-block"> 
                    <p> কনটেন্টটি শেষ হাল-নাগাদ করা হয়েছে: <?= $updated_at ?? 'সম্প্রতি' ?> </p> 
                </div> 
                <div class="widget print-widget"> 
                    <div onclick="window._print_content(this);" title="প্রিন্ট"><i class="ph ph-printer"></i></div> 
                </div> 
                <div class="widget title-with-image-content-widget"> 
                    <h2> <?= $title ?> </h2> 
                    <p class="chips"> 
                        <span class="basic-chip">কন্টেন্ট: পাতা</span> 
                    </p> 
                    <div class="content-body">
                        <?= $content ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
