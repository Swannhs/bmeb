<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?></title>
    
    <!-- Original Styling from public/index.html -->
    <style>
        html{
            --color-primary-bg:#00A63E;
            --color-primary-light:#2DAB5B;
            --color-primary-dark:#008532;
            --color-primary-text:#ffffff;
            --color-secondary-bg:#DC2626;
            --color-secondary-light:#FEF2F2;
            --color-secondary-dark:#ED3131;
            --color-secondary-text:#ffffff;
            --color-normal-bg:#ffffff;
            --color-normal-light:#f0f0f0;
            --color-normal-dark:#e0e0e0;
            --color-normal-text:#000000;
            --color-dark-bg:#000000;
            --color-dark-light:#202020;
            --color-dark-dark:#404040;
            --color-dark-text:#ffffff;
            --color-success-bg:#28a745;
            --color-success-text:#ffffff;
            --color-danger-bg:#dc3545;
            --color-danger-text:#dc3545;
            --color-warning-bg:#FF6600;
            --color-warning-text:#FF6600;
            --color-info-bg:#17a2b8;
            --color-info-text:#ffffff;
            --color-link-normal:#1568b2;
            --color-link-dark:#1b81dd;
            --color-border-normal:#d0d0d0;
            --color-border-dark:#909090;
            --background-primary-image:url(<?= base_url('site-assets/images/bg.png') ?>);
            --background-primary-repeat:repeat;
            --background-primary-position:center center;
            --background-primary-color:#ffffff;
            --background-secondary-image:url(<?= base_url('site-assets/images/bg.png') ?>);
            --background-secondary-repeat:repeat;
            --background-secondary-position:center center;
            --background-secondary-color:#ffffff;
            --container-small:600px;
            --container-medium:900px;
            --container-large:1200px;
            --spacing-small:8px;
            --spacing-medium:16px;
            --spacing-large:24px;
            --radius-small:4px;
            --radius-medium:8px;
            --radius-large:16px;
            --shadow-small:0px 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-medium:0px 4px 8px rgba(0, 0, 0, 0.1);
            --shadow-large:0px 8px 16px rgba(0, 0, 0, 0.1);
            --text-small:0.75rem;
            --text-medium:0.9rem;
            --text-large:1.25rem;
            --font-heading-en:NotoSansBengali-Regular, sans-serif;
            --font-heading-bn:NotoSansBengali-Regular, sans-serif;
            --font-primary-en:NotoSansBengali-Regular, sans-serif;
            --font-primary-bn:NotoSansBengali-Regular, sans-serif;
            --font-secondary-en:NotoSansBengali-Regular, sans-serif;
            --font-secondary-bn:NotoSansBengali-Regular, sans-serif;
            --typography-h1-font-family:var(--font-heading);
            --typography-h1-font-weight:700;
            --typography-h1-font-size:32px;
            --typography-h1-line-height:1.2;
            --typography-h2-font-family:var(--font-heading);
            --typography-h2-font-weight:700;
            --typography-h2-font-size:28px;
            --typography-h2-line-height:1.2;
            --typography-h3-font-family:var(--font-heading);
            --typography-h3-font-weight:600;
            --typography-h3-font-size:24px;
            --typography-h3-line-height:1.5;
            --typography-h4-font-family:var(--font-heading);
            --typography-h4-font-weight:500;
            --typography-h4-font-size:20px;
            --typography-h4-line-height:1.5;
            --typography-h5-font-family:var(--font-heading);
            --typography-h5-font-weight:500;
            --typography-h5-font-size:18px;
            --typography-h5-line-height:1.5;
            --typography-h6-font-family:var(--font-heading);
            --typography-h6-font-weight:400;
            --typography-h6-font-size:16px;
            --typography-h6-line-height:1.5;
            --typography-body-font-family:var(--font-primary);
            --typography-body-font-weight:400;
            --typography-body-font-size:14px;
            --typography-body-line-height:1.2;
            --typography-p-font-family:var(--font-primary);
            --typography-p-font-weight:400;
            --typography-p-font-size:14px;
            --typography-p-line-height:1.2;
            --typography-a-font-family:var(--font-secondary);
            --typography-a-font-weight:400;
            --typography-a-font-size:14px;
            --typography-a-line-height:1.2;
        }
        html,html[lang="en"]{
            --font-heading:NotoSansBengali-Regular, sans-serif;
            --font-primary:NotoSansBengali-Regular, sans-serif;
            --font-secondary:NotoSansBengali-Regular, sans-serif;
        }
        html[lang="bn"]{
            --font-heading:NotoSansBengali-Regular, sans-serif;
            --font-primary:NotoSansBengali-Regular, sans-serif;
            --font-secondary:NotoSansBengali-Regular, sans-serif;
        }

        /* ===== CONTAINER ===== */
        body{overflow-x:hidden; background-color: var(--background-primary-color);}
        .col{flex:0 0 auto;}
        .container-row,.widget-container-row{
            --col-gutter-x: var(--spacing-medium);
            --col-gutter-y:0;
            display:flex;
            flex-wrap:wrap;
            margin-top:calc(-1 * var(--col-gutter-y));
            margin-right:calc(-.5 * var(--col-gutter-x));
            margin-left:calc(-.5 * var(--col-gutter-x))
        }
        .container-row>*,.widget-container-row>*{
            box-sizing:border-box;
            flex-shrink:0;
            width:100%;
            max-width:100%;
            padding-right:calc(var(--col-gutter-x) * .5);
            padding-left:calc(var(--col-gutter-x) * .5);
            margin-top:var(--col-gutter-y)
        }

        @media (min-width:600px) {
            .container-col-1{width:8.3333%;}
            .container-col-2{width:16.666%;}
            .container-col-3{width:25%;}
            .container-col-4{width:33.333%;}
            .container-col-5{width:41.666%;}
            .container-col-6{width:50%;}
            .container-col-7{width:58.333%;}
            .container-col-8{width:66.666%;}
            .container-col-9{width:75%;}
            .container-col-10{width:83.333%;}
            .container-col-11{width:91.666%;}
            .container-col-12{width:100%;}
        }
    </style>

    <!-- External Assets -->
    <link rel="stylesheet" href="<?= base_url('site-assets/css/phosphor.css') ?>">
    <link rel="stylesheet" href="<?= base_url('site-assets/css/phosphor-fill.css') ?>">
    <link rel="stylesheet" href="<?= base_url('site-assets/css/index.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/HeaderWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/OfficeFindThreeWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/GlobalSearchWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/LanguageSwitcherWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/BannerSliderImageWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/MenusExpandableWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/MenusWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/NoticeNewsCardWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('widget-assets/css/FooterWidget.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">

    <?= $this->renderSection('extra-css') ?>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <?= $this->include('templates/header') ?>
        </div>

        <div class="wrapper">
            <!-- Main Content Area -->
            <div class="body">
                <?= $this->renderSection('content') ?>
            </div>

            <!-- Right Sidebar -->
            <div class="right">
                <?= $this->include('templates/sidebar_right') ?>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <?= $this->include('templates/footer') ?>
        </div>
    </div>

    <!-- Floating Widgets -->
    <div data-widget_type="widget" data-widget_name="AccessibilityWidget" class="widget accessibility-widget"> 
        <div class="accessibility-float fab-icon" id="accessibility-btn" title="এক্সেসিবিলিটি"> <i class="ph ph-wheelchair-motion"></i> </div> 
        <div class="accessibility-card" id="accessibility-card" style="display:none;"> 
            <h3 id="accessibility-card-title">এক্সেসিবিলিটি</h3> 
            <div class="item"> <button id="font-increase">ফন্ট বৃদ্ধি</button> <button id="font-decrease">ফন্ট হ্রাস</button> </div> 
            <div class="item"> <input type="checkbox" id="monochrome" /> <label for="monochrome">মনোক্রোম</label> </div> 
            <button class="accessibility-reset">রিসেট</button> 
        </div> 
    </div> 

    <div data-widget_type="widget" data-widget_name="GoToTopWidget" class="widget go-to-top-widget"> 
        <div class="go-to-top-float x-fab-icon" id="go-to-top-btn" title="উপরে যান"> <i class="ph ph-caret-up"></i> </div> 
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('site-assets/js/index.js') ?>"></script>
    <script src="<?= base_url('widget-assets/js/HeaderWidget.js') ?>"></script>
    <script src="<?= base_url('widget-assets/js/BannerSliderImageWidget.js') ?>"></script>
    <script src="<?= base_url('widget-assets/js/MenusWidget.js') ?>"></script>
    <script src="<?= base_url('widget-assets/js/MenusExpandableWidget.js') ?>"></script>
    <script src="<?= base_url('assets/js/index.js') ?>"></script>
    
    <?= $this->renderSection('extra-js') ?>
</body>
</html>
