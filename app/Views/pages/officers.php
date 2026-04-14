<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>কর্মকর্তাবৃন্দ | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    <div data-widget_type="widget" data-widget_name="ContentBrowseWidget" class="widget content-browse-widget"> 
        <div class="title-bar"> 
            <div> <h2>কর্মকর্তাবৃন্দ</h2> </div> 
        </div> 
        
        <div class="container-group"> 
            <div class="searchbar"> 
                <input type="text" name="search" id="search" placeholder="অনুসন্ধান" /> 
                <button id="search-btn"><i class="ph ph-magnifying-glass"></i></button> 
            </div> 
        </div> 

        <div class="browse-items view-type-list grouped-view"> 
            <!-- Officer 1 -->
            <div class="widget employee-content-widget"> 
                <div class="list-card-body"> 
                    <div class="list-card-body-sl"> ১ </div> 
                    <div class="image-section"> 
                        <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/9e0ef9ab396b4f7e96b8602de11711c7.jpg" class="list-card-image" alt="নূরুল হক"> 
                    </div> 
                    <div class="right-section"> 
                        <table> 
                            <tbody> 
                                <tr> <td>নাম</td> <td>প্রফেসর মিঞা মোঃ নূরুল হক</td> </tr> 
                                <tr> <td>পদবি</td> <td>চেয়ারম্যান</td> </tr> 
                                <tr> <td>অফিস</td> <td>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড</td> </tr> 
                                <tr> <td>ইমেইল</td> <td>chairman@bmeb.gov.bd</td> </tr> </tbody> 
                        </table> 
                    </div> 
                    <div class="right-section"> 
                        <table> 
                            <tbody> 
                                <tr> <td>ফোন (অফিস)</td> <td>০২৫৮৬১০২১৬</td> </tr> 
                                <tr> <td>মোবাইল</td> <td>০১৭১৩০০১২৩২</td> </tr> </tbody> 
                        </table> 
                        <div class="see-all-btn-block"> 
                            <a class="see-all-btn" href="#"> দেখুন </a> 
                        </div> 
                    </div> 
                </div> 
            </div> 

            <!-- Officer 2 -->
            <div class="widget employee-content-widget"> 
                <div class="list-card-body"> 
                    <div class="list-card-body-sl"> ২ </div> 
                    <div class="image-section"> 
                        <img src="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/5fb070181013449fa7bf026022af9229.jpg" class="list-card-image" alt="ছালেহ আহমাদ"> 
                    </div> 
                    <div class="right-section"> 
                        <table> 
                            <tbody> 
                                <tr> <td>নাম</td> <td>প্রফেসর ছালেহ আহমাদ</td> </tr> 
                                <tr> <td>পদবি</td> <td>রেজিস্ট্রার</td> </tr> 
                                <tr> <td>অফিস</td> <td>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড</td> </tr> 
                                <tr> <td>ইমেইল</td> <td>registrar@bmeb.gov.bd</td> </tr> </tbody> 
                        </table> 
                    </div> 
                    <div class="right-section"> 
                        <table> 
                            <tbody> 
                                <tr> <td>ফোন (অফিস)</td> <td>০২৯৬১২৮৫৮</td> </tr> 
                                <tr> <td>মোবাইল</td> <td>০১৩২৪৭২৭৩৬৫</td> </tr> </tbody> 
                        </table> 
                        <div class="see-all-btn-block"> 
                            <a class="see-all-btn" href="#"> দেখুন </a> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            
            <!-- Additional officers can be added here -->
        </div> 
    </div>
</div>
<?= $this->endSection() ?>
