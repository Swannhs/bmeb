<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>হোম | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    
    <?php foreach ($sections['main'] ?? [] as $section): ?>
        <?php switch ($section['section_key']):
            case 'marquee': ?>
                <div class="wrapper ck-content">
                    <marquee class="custom-marquee" direction="left" scrollamount="7" onmouseover="this.stop()" onmouseout="this.start()">
                        <?= $section['content'] ?>
                    </marquee>
                </div>
                <?php break; ?>

            <?php case 'notice_board': ?>
                <section data-widget_type="widget" data-widget_name="NoticeNewsCardWidget" class="widget notice-news-card-widget"> 
                    <div class="notice-card"> 
                        <p class="notice-title"><i class="ph ph-file-text"></i> <?= esc($section['title']) ?></p> 
                        <ul class="notice-unordered-list"> 
                            <?php if (!empty($notices)): ?>
                                <?php foreach ($notices as $notice): ?>
                                <li class="notice-content-list"> 
                                    <a class="notice-link" href="<?= base_url('pages/notices/' . ($notice['slug'] ?? '')) ?>"> 
                                        <div class="notice-content-icon"><i class="dot"></i></div> 
                                        <div class="notice-text-wrap"> 
                                            <p class="notice-text" title="<?= $notice['title'] ?>"> <?= $notice['title'] ?> </p> 
                                            <p class="notice-text">
                                                <span class="notice-tag"><i class="ph ph-calendar-dots"></i> <?= $notice['publish_date'] ?></span> 
                                                <?php if (isset($notice['is_new']) && $notice['is_new']): ?>
                                                    <strong class="notice-tag">নতুন</strong>
                                                <?php endif; ?>
                                                <strong class="notice-tag">সাধারণ</strong>
                                            </p> 
                                        </div> 
                                        <div class="notice-content-icon"> <i class="ph ph-caret-right"></i> </div>
                                    </a> 
                                </li> 
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>কোনো তথ্য পাওয়া যায়নি।</p>
                            <?php endif; ?>
                        </ul> 
                        <div class="all-btn"> 
                            <a href="<?= base_url('pages/notices') ?>"> সকল নোটিশ দেখুন <i class="ph ph-arrow-right"></i> </a> 
                        </div>
                    </div> 

                    <?php if (isset($section_data['news_ticker'])): ?>
                    <div class="news-card"> 
                        <section class="widget news-card-widget"> 
                            <div class="news-card-widget-scroll-container"> 
                                <div class="news-card-widget-news-title">খবর</div> 
                                <div class="news-card-widget-ticker">
                                    <marquee behavior="scroll" direction="left"><?= esc($section_data['news_ticker']['content']) ?></marquee>
                                </div> 
                                <div class="all-btn"> 
                                    <a href="<?= base_url('pages/news-archive') ?>"> আর্কাইভ দেখুন </a> 
                                </div> 
                            </div> 
                        </section> 
                    </div>
                    <?php endif; ?>
                </section>
                <?php break; ?>

            <?php case 'news_ticker': ?>
                <!-- Rendered inside notice_board for layout parity, or can be standalone if needed -->
                <?php break; ?>

            <?php case 'service_grid': ?>
                <?php $gridData = json_decode($section['content'], true); ?>
                <section data-widget_type="widget" data-widget_name="ServiceBoxExpandableStackWidget" class="widget service-box-expandable-stack-widget"> 
                    <section class="widget service-box-stack-widget widget-container-row"> 
                        <div class="service-box-stack-widget-header"> 
                            <p class="service-box-stack-widget-title"> <?= esc($section['title']) ?> </p> 
                        </div> 
                        
                        <?php if (is_array($gridData)): foreach ($gridData as $box): ?>
                        <div class='container-col-6'> 
                            <div class="widget service-box-widget"> 
                                <h1 class="service-box-title"> <?= esc($box['title']) ?> </h1> 
                                <div class="service-box-grid">
                                    <div class="service-box-col-span-4 service-box-img-container">
                                        <img src="<?= esc($box['image']) ?>" alt="icon" />
                                    </div>
                                    <div class="service-box-col-span-8">
                                        <ul class="service-box-list"> 
                                            <?php foreach ($box['links'] as $link): ?>
                                            <li class="service-box-list-item">
                                                <div class="service-box-bullet"></div>
                                                <a target="<?= esc($link['target'] ?? '_self') ?>" href="<?= str_starts_with($link['url'], 'http') ? esc($link['url']) : base_url($link['url']) ?>">
                                                    <?= esc($link['label']) ?>
                                                </a>
                                            </li> 
                                            <?php endforeach; ?>
                                        </ul> 
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <?php endforeach; endif; ?>
                        
                    </section> 
                    <div class="all-btn-wrapper"> 
                        <label class="all-btn"> সকল সেবাসমূহ দেখুন </label> 
                    </div>
                </section>
                <?php break; ?>
            
            <?php default: ?>
                <!-- Custom HTML sections -->
                <?php if ($section['type'] === 'html'): ?>
                    <div class="wrapper ck-content">
                        <?= $section['content'] ?>
                    </div>
                <?php endif; ?>
        <?php endswitch; ?>
    <?php endforeach; ?>

</div>
<?= $this->endSection() ?>
