<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= esc($title) ?> | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-wrapper" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.05);">
    <!-- Breadcrumbs -->
    <div class="breadcrumb-container mb-4" style="font-size: 13px;">
        <a href="/" style="color: var(--color-primary-bg); text-decoration: none;">হোম</a>
        <span style="margin: 0 8px; color: #ccc;">/</span>
        <span style="color: #666;"><?= esc($title) ?></span>
    </div>

    <!-- Page Title Section -->
    <div class="page-header mb-5" style="border-bottom: 2px solid #f0f0f0; padding-bottom: 20px;">
        <h1 style="font-size: 28px; color: #1e293b; font-weight: 700; margin-bottom: 10px;"><?= esc($title) ?></h1>
        <div style="display: flex; gap: 20px; color: #888; font-size: 13px;">
            <span><i class="ph ph-calendar-blank"></i> আপডেট: <?= date('d M, Y') ?></span>
            <span><i class="ph ph-eye"></i> ১.৫কে ভিউ</span>
        </div>
    </div>

    <!-- Content Area -->
    <div class="page-content mirrored-content" style="line-height: 1.8; color: #334155; font-size: 16px;">
        <?= $content ?>
    </div>

    <!-- Helpful Links Card -->
    <div style="margin-top: 50px; background: #f8fafc; border-radius: 12px; padding: 25px; border: 1px solid #e2e8f0;">
        <h5 style="color: #1e293b; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center;">
            <i class="ph ph-link-simple" style="margin-right: 10px; color: var(--color-primary-bg);"></i>
            আপনার জন্য প্রয়োজনীয় লিংক
        </h5>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
            <a href="/pages/notices" class="quick-link">সকল নোটিশ দেখুন</a>
            <a href="/pages/officers" class="quick-link">কর্মকর্তাদের তালিকা</a>
            <a href="/p/contact-us" class="quick-link">যোগাযোগ করুন</a>
            <a href="#" class="quick-link">সিটিজেন চার্টার</a>
        </div>
    </div>

    <!-- Print & Share -->
    <div style="margin-top: 40px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; pt: 20px;">
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" style="background: none; border: 1px solid #ddd; padding: 5px 15px; border-radius: 4px; cursor: pointer; font-size: 13px;">
                <i class="ph ph-printer"></i> প্রিন্ট
            </button>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="font-size: 13px; color: #666;">শেয়ার করুন:</span>
            <a href="#" style="color: #3b5998; font-size: 20px;"><i class="ph-fill ph-facebook-logo"></i></a>
            <a href="#" style="color: #25d366; font-size: 20px;"><i class="ph-fill ph-whatsapp-logo"></i></a>
        </div>
    </div>
</div>

<style>
    .mirrored-content h2 { font-size: 22px; color: #1e293b; margin-top: 30px; margin-bottom: 15px; font-weight: 700; border-left: 4px solid var(--color-primary-bg); padding-left: 15px; }
    .mirrored-content p { margin-bottom: 20px; }
    .mirrored-content ul { padding-left: 20px; margin-bottom: 20px; }
    .mirrored-content li { margin-bottom: 8px; }
    .quick-link { 
        background: #fff; 
        padding: 12px 15px; 
        border-radius: 8px; 
        text-decoration: none; 
        color: #475569; 
        font-size: 14px; 
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
        text-align: center;
    }
    .quick-link:hover { 
        border-color: var(--color-primary-bg); 
        color: var(--color-primary-bg); 
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
</style>
<?= $this->endSection() ?>


