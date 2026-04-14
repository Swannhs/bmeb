<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>হোম | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    <!-- Marquee Notice -->
    <div data-widget_type="widget" data-widget_name="BlockWidget" class="widget block-widget"> 
        <div class="block-widget-container"> 
            <marquee class="custom-marquee" direction="left" scrollamount="7">
                <span style="color:red; font-size:20px">শিক্ষা প্রতিষ্ঠান, শিক্ষক-কর্মচারী ও ছাত্র-ছাত্রীদের আর্থিক অনুদানের আবেদন দাখিল প্রাইভেট পরীক্ষা ২০২৬ এর রেজিস্ট্রেশন কার্ড সংক্রান্ত...</span>
            </marquee>
        </div> 
    </div>

    <!-- Notice & News Section -->
    <section data-widget_type="widget" data-widget_name="NoticeNewsCardWidget" class="widget notice-news-card-widget"> 
        <div class="notice-card"> 
            <p class="notice-title"><i class="ph ph-file-text"></i> নোটিশ বোর্ড</p> 
            <ul class="notice-unordered-list"> 
                <li class="notice-content-list"> 
                    <a class="notice-link" href="#"> 
                        <div class="notice-content-icon"><i class="dot"></i></div> 
                        <div class="notice-text-wrap"> 
                            <p class="notice-text"> সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে </p> 
                            <p class="notice-text"><span class="notice-tag"><i class="ph ph-calendar-dots"></i> ১৩-০৪-২০২৬</span> <strong class="notice-tag">নতুন</strong></p> 
                        </div> 
                    </a> 
                </li> 
                <li class="notice-content-list"> 
                    <a class="notice-link" href="#"> 
                        <div class="notice-content-icon"><i class="dot"></i></div> 
                        <div class="notice-text-wrap"> 
                            <p class="notice-text"> ২০২৬ সালের ৬ষ্ঠ শ্রেণির রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন প্রসঙ্গে। </p> 
                            <p class="notice-text"><span class="notice-tag"><i class="ph ph-calendar-dots"></i> ১৩-০৪-২০২৬</span> <strong class="notice-tag">নতুন</strong></p> 
                        </div> 
                    </a> 
                </li> 
            </ul> 
            <div class="all-btn"> 
                <a href="#"> সকল নোটিশ দেখুন <i class="ph ph-arrow-right"></i> </a> 
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
                        <a href="#"> আর্কাইভ দেখুন </a> 
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
                                <li class="service-box-list-item"><a href="#">আলিম ২০২৫ এর ফলাফল</a></li> 
                                <li class="service-box-list-item"><a href="#">ই ফাইলিং</a></li> 
                                <li class="service-box-list-item"><a href="#">EIIN সিম উত্তোলন</a></li>
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
                                <li class="service-box-list-item"><a href="#">পুরাতন ওয়েবসাইট</a></li> 
                                <li class="service-box-list-item"><a href="#">e-SIF / e-FF</a></li> 
                                <li class="service-box-list-item"><a href="#">বৃত্তি পরীক্ষার পরীক্ষক তালিকা</a></li>
                            </ul> 
                        </div>
                    </div>
                </div> 
            </div> 
        </section> 
    </section>
</div>
<?= $this->endSection() ?>
