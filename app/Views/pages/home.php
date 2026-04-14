<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>হোম | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    <!-- Notice & News Section -->
    <section data-widget_type="widget" data-widget_name="NoticeNewsCardWidget" class="widget notice-news-card-widget"> 
        <div class="notice-card"> 
            <p class="notice-title"><i class="ph ph-file-text"></i> নোটিশ বোর্ড</p> 
            <ul class="notice-unordered-list"> 
                <?php if (!empty($notices)): ?>
                    <?php foreach ($notices as $notice): ?>
                    <li class="notice-content-list"> 
                        <a class="notice-link" href="<?= base_url('pages/notices/' . $notice['slug']) ?>"> 
                            <div class="notice-content-icon"><i class="dot"></i></div> 
                            <div class="notice-text-wrap"> 
                                <p class="notice-text" title="<?= $notice['title'] ?>"> <?= $notice['title'] ?> </p> 
                                <p class="notice-text">
                                    <span class="notice-tag"><i class="ph ph-calendar-dots"></i> <?= $notice['publish_date'] ?></span> 
                                    <?php if ($notice['is_new']): ?>
                                        <strong class="notice-tag">নতুন</strong>
                                    <?php endif; ?>
                                </p> 
                            </div> 
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

        <div class="news-card"> 
            <section class="widget news-card-widget"> 
                <div class="news-card-widget-scroll-container"> 
                    <div class="news-card-widget-news-title">খবর</div> 
                    <div class="news-card-widget-ticker">
                        <marquee behavior="scroll" direction="left">কিছু সময়ের মধ্যে সর্বশেষ সংবাদ আপলোড করা হবে...</marquee>
                    </div> 
                    <div class="all-btn"> 
                        <a href="<?= base_url('pages/news-archive') ?>"> আর্কাইভ দেখুন </a> 
                    </div> 
                </div> 
            </section> 
        </div>
    </section>

    <!-- Services Grid -->
    <section data-widget_type="widget" data-widget_name="ServiceBoxExpandableStackWidget" class="widget service-box-expandable-stack-widget"> 
        <section class="widget service-box-stack-widget widget-container-row"> 
            <div class="service-box-stack-widget-header"> 
                <p class="service-box-stack-widget-title"> সেবা সমূহ </p> 
                <a href="#" class="service-box-stack-widget-link"> সব দেখুন </a> 
            </div> 
            
            <div class='container-col-6'> 
                <div class="widget service-box-widget"> 
                    <h1 class="service-box-title" style="color: black;"> অনলাইন সেবা-১ </h1> 
                    <div class="service-box-grid">
                        <div class="service-box-col-span-4 service-box-img-container">
                            <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/332b5cc9bd7e41919baac882453ef550.png" alt="icon" />
                        </div>
                        <div class="service-box-col-span-8">
                            <ul class="service-box-list"> 
                                <li class="service-box-list-item"><a target="_blank" href="https://ebmeb.gov.bd/erps_entry_forms/disp_res.php?exam=alm&year=2025">আলিম ২০২৫ এর ফলাফল</a></li> 
                                <li class="service-box-list-item"><a target="_blank" href="http://efiling.ebmeb.gov.bd/index.php/eservice/">ই ফাইলিং</a></li> 
                                <li class="service-box-list-item"><a target="_blank" href="http://efiling.ebmeb.gov.bd/index.php/eiinsim/">EIIN সিম উত্তোলন</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div> 
            
            <div class='container-col-6'> 
                <div class="widget service-box-widget"> 
                    <h1 class="service-box-title" style="color: black;"> অনলাইন সেবা-২ </h1> 
                    <div class="service-box-grid">
                        <div class="service-box-col-span-4 service-box-img-container">
                            <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/ee95df6882674a2b9dba7dfd26792d30.jpg" alt="icon" />
                        </div>
                        <div class="service-box-col-span-8">
                            <ul class="service-box-list"> 
                                <li class="service-box-list-item"><a target="_blank" href="http://bmeb.ebmeb.gov.bd/">পুরাতন ওয়েবসাইট</a></li> 
                                <li class="service-box-list-item"><a target="_blank" href="http://www.ebmeb.gov.bd/">e-SIF / e-FF</a></li> 
                                <li class="service-box-list-item"><a target="_blank" href="https://tinyurl.com/ebt25examiner">বৃত্তি পরীক্ষার পরীক্ষক তালিকা</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div> 
        </section> 
    </section>
</div>
<?= $this->endSection() ?>
