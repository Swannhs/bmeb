<?php
$sliderModel = new \App\Models\SliderModel();
$sliders = $sliderModel->orderBy('sort_order', 'ASC')->findAll();
?>
<div style="height: 20px; background-color: var(--color-primary-bg); width: 100%; border-radius: 8px 8px 0 0;"></div>
<div data-widget_type="widget" data-widget_name="BannerSliderImageWidget" class="widget banner-slider-image-widget"> 
    <div class="home-carousel"> 
        <?php if (!empty($sliders)): ?>
            <?php foreach ($sliders as $index => $slider): ?>
                <a class="slider images" target="_blank" style="<?= $index === 0 ? 'display:block;' : 'display:none;' ?>">
                    <img class="slider-image <?= $index === 0 ? 'active' : '' ?>" src="<?= esc($slider['image_url']) ?>" alt="Slider <?= $index+1 ?>">
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <a class="slider images" target="_blank" style="display:block;">
                <img class="slider-image active" src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/918e335631dd45fdb5599a3d1eefc91f.jpg" alt="Default Banner"> 
            </a>
        <?php endif; ?>
        <div class="slider-overlay widget-container-row"> 
            <div class="slider-left container-col-4"> 
                <a href="<?= base_url() ?>"> 
                    <img class="office-logo" src="<?= base_url('site-assets/images/logo.png') ?>" alt="Office Logo"> 
                </a> 
                <div class="office-left-section"> 
                    <h1><a style="text-decoration: none" href="<?= base_url() ?>" class="office-title"> বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড </a></h1> 
                </div> 
            </div> 
            <div class="slider-controls container-col-4"> 
                <button class="nav-btn slider-previous"><i class="ph ph-caret-left"></i></button> 
                <button class="nav-btn slider-play"><i class="ph ph-play"></i></button> 
                <button class="nav-btn slider-next"><i class="ph ph-caret-right"></i></button> 
            </div> 
        </div> 
    </div> 
</div>

