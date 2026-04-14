<section data-widget_type="widget" data-widget_name="HeaderWidget" class="widget header-widget-section"> 
    <div class="header-left-section"> 
        <a class="header-title" href="http://bangladesh.gov.bd" title="বাংলাদেশ জাতীয় তথ্য বাতায়ন"> বাংলাদেশ জাতীয় তথ্য বাতায়ন </a> 
    </div> 
    
    <div class="header-left-section" style="margin-left: 20px;">
        <div class="widget header-dropdown office-findthree-widget">
            <select name="officeType" class="office-select">
                <option value="">অফিসের ধরণ নির্বাচন করুন</option>
                <option value="ministry">মন্ত্রণালয়</option>
                <option value="autonomous">স্বায়ত্তশাসিত</option>
            </select>
            <button class="go-btn">দেখুন</button>
        </div>
    </div>

    <div class="global-searchbar custom-items-center"> 
        <div class='widget global-search-widget'> 
            <input class="input-search" name="key" placeholder="এখানে খুঁজুন..." /> 
            <button type="button" class="btn-search"> অনুসন্ধান </button> 
        </div> 
        <div class='widget language-switcher-widget'> 
            <button type="button" class="btn-lang-change" onclick="alert('Language switching is coming soon!')"> English </button> 
        </div> 
    </div> 
</section> 

<?= $this->include('templates/banner') ?>
<?= $this->include('templates/menu') ?>

<!-- Global Marquee -->
<div data-widget_type="widget" data-widget_name="BlockWidget" class="widget block-widget" style="margin-top: 10px;"> 
    <div class="block-widget-container"> 
        <marquee class="custom-marquee" direction="left" scrollamount="7" onmouseover="this.stop()" onmouseout="this.start()">
            <span style="color:red; font-size:18px">শিক্ষা প্রতিষ্ঠান, শিক্ষক-কর্মচারী ও ছাত্র-ছাত্রীদের আর্থিক অনুদানের আবেদন দাখিল প্রাইভেট পরীক্ষা ২০২৬ এর রেজিস্ট্রেশন কার্ড সংক্রান্ত। ৬ষ্ঠ, ৭ম এবং ৮ম শ্রেণীর ছাড়পত্রের জন্য ফরম পূরণ করে সরাসরি বোর্ডে জমা দিতে হবে। দাখিল এবং আলিমের ছাড়পত্র যথানিয়মে অনলাইনে চলমান রয়েছে। </span>
        </marquee>
    </div> 
</div>
