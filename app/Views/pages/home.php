<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>হোম | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    <!-- Marquee Section -->
    <div class="wrapper ck-content">
        <marquee class="custom-marquee" direction="left" scrollamount="7" onmouseover="this.stop()" onmouseout="this.start()">
            <p>
                <a href="<?= base_url('p/69b63abc4c91bada4f8654f8') ?>"><span style="color:rgb(255,0,0);font-size:20px; font-weight: bold;">শিক্ষা প্রতিষ্ঠান, শিক্ষক-কর্মচারী ও ছাত্র-ছাত্রীদের আর্থিক অনুদানের আবেদন</span></a>
                <span style="color:rgb(255,0,0);font-size:20px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; দাখিল প্রাইভেট পরীক্ষা ২০২৬ এর রেজিস্ট্রেশন কার্ড বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড এর রেজিস্ট্রেশন শাখা( রুম নম্বর -২১০) থেকে সংগ্রহ করার জন্য সকল কেন্দ্র সচিব অথবা তার বৈধ প্রতিনিধি পাঠানোর জন্য নির্দেশক্রমে অনুরোধ করা হলো &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; দাখিল স্থাপনের অনুমতিপ্রাপ্ত মাদ্রাসার উদ্যোক্তা কমিটি’র আবেদন এখন থেকে অনলাইনে গ্রহণ করা হবে।</span>
            </p>
        </marquee>
    </div>

    <!-- Notice & News Section -->
    <section data-widget_type="widget" data-widget_name="NoticeNewsCardWidget" class="widget notice-news-card-widget"> 
        <div class="notice-card"> 
            <p class="notice-title"><i class="ph ph-file-text"></i> নোটিশ বোর্ড</p> 
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

        <div class="news-card"> 
            <section class="widget news-card-widget"> 
                <div class="news-card-widget-scroll-container"> 
                    <div class="news-card-widget-news-title">খবর</div> 
                    <div class="news-card-widget-ticker">
                        <marquee behavior="scroll" direction="left">দাখিল পরীক্ষা-২০২৬ এর কেন্দ্রসচিবদের সাথে জুম মিটিং...</marquee>
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
            </div> 
            
            <div class='container-col-6'> 
                <div class="widget service-box-widget"> 
                    <h1 class="service-box-title"> অনলাইন সেবা </h1> 
                    <div class="service-box-grid">
                        <div class="service-box-col-span-4 service-box-img-container">
                            <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/332b5cc9bd7e41919baac882453ef550.png" alt="icon" />
                        </div>
                        <div class="service-box-col-span-8">
                            <ul class="service-box-list"> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="https://ebmeb.gov.bd/erps_entry_forms/disp_res.php?exam=alm&year=2025">আলিম ২০২৫ এর ফলাফল</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="http://efiling.ebmeb.gov.bd/index.php/eservice/">ই ফাইলিং</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="http://efiling.ebmeb.gov.bd/index.php/eiinsim/">EIIN সিম উত্তোলন</a></li>
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="http://bmeb.ebmeb.gov.bd/">পুরাতন ওয়েবসাইট</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div> 
            
            <div class='container-col-6'> 
                <div class="widget service-box-widget"> 
                    <h1 class="service-box-title"> অভ্যন্তরীণ ই-সেবা </h1> 
                    <div class="service-box-grid">
                        <div class="service-box-col-span-4 service-box-img-container">
                            <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/9af460720442472b89b4961b30b474d5.png" alt="icon" />
                        </div>
                        <div class="service-box-col-span-8">
                            <ul class="service-box-list"> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="http://www.ebmeb.gov.bd/">e-SIF / e-FF</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="https://tinyurl.com/ebt25examiner">পরীক্ষক তালিকা</a></li>
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="https://ebmeb.gov.bd/">রেজিস্ট্রেশন কার্ড সংশোধন</a></li>
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a target="_blank" href="https://ebmeb.gov.bd/">বৃত্তি পরীক্ষার ফলাফল</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div> 

            <div class='container-col-6'> 
                <div class="widget service-box-widget"> 
                    <h1 class="service-box-title"> শুদ্ধাচার ও সুশাসন </h1> 
                    <div class="service-box-grid">
                        <div class="service-box-col-span-4 service-box-img-container">
                            <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/70e479c5bd4345a99d6d48ea9afefde4.png" alt="icon" />
                        </div>
                        <div class="service-box-col-span-8">
                            <ul class="service-box-list"> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a href="<?= base_url('p/691997b9933eb65569dde769') ?>">শুদ্ধাচার কৌশল কর্মপরিকল্পনা</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a href="<?= base_url('p/691997bc933eb65569ddea7d') ?>">ফোকাল পয়েন্ট কর্মকর্তা</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a href="<?= base_url('p/691997b1933eb65569dde10f') ?>">মূল্যায়ন প্রতিবেদন</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div>

            <div class='container-col-6'> 
                <div class="widget service-box-widget"> 
                    <h1 class="service-box-title"> এসডিজি </h1> 
                    <div class="service-box-grid">
                        <div class="service-box-col-span-4 service-box-img-container">
                            <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/51b80884ec7a47a1b829b608398b837b.png" alt="icon" />
                        </div>
                        <div class="service-box-col-span-8">
                            <ul class="service-box-list"> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a href="<?= base_url('p/691997a8933eb65569ddd91a') ?>">জাতীয় দলিল</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a href="<?= base_url('p/691997ba933eb65569dde899') ?>">এসডিজি সংক্রান্ত জিও</a></li> 
                                <li class="service-box-list-item"><div class="service-box-bullet"></div><a href="<?= base_url('p/691997ba933eb65569dde899') ?>">কর্মপরিকল্পনা</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div>
            
        </section> 
        <div class="all-btn-wrapper"> 
            <label class="all-btn"> সকল সেবাসমূহ দেখুন </label> 
        </div>
    </section>
</div>
<?= $this->endSection() ?>
