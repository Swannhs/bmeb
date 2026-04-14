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
            <?php if (!empty($officers)): ?>
                <?php foreach ($officers as $index => $officer): ?>
                <div class="widget employee-content-widget"> 
                    <div class="list-card-body"> 
                        <div class="list-card-body-sl"> <?= $index + 1 ?> </div> 
                        <div class="image-section"> 
                            <img src="<?= $officer['photo_url'] ?: base_url('site-assets/images/placeholder-officer.jpg') ?>" class="list-card-image" alt="<?= $officer['name'] ?>"> 
                        </div> 
                        <div class="right-section"> 
                            <table> 
                                <tbody> 
                                    <tr> <td>নাম</td> <td><?= $officer['name'] ?></td> </tr> 
                                    <tr> <td>পদবি</td> <td><?= $officer['designation'] ?></td> </tr> 
                                    <tr> <td>অফিস</td> <td><?= $officer['office'] ?></td> </tr> 
                                    <tr> <td>ইমেইল</td> <td><?= $officer['email'] ?></td> </tr> </tbody> 
                            </table> 
                        </div> 
                        <div class="right-section"> 
                            <table> 
                                <tbody> 
                                    <tr> <td>ফোন (অফিস)</td> <td><?= $officer['phone_office'] ?></td> </tr> 
                                    <tr> <td>মোবাইল</td> <td><?= $officer['mobile'] ?></td> </tr> </tbody> 
                            </table> 
                            <div class="see-all-btn-block"> 
                                <a class="see-all-btn" href="#"> দেখুন </a> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
                <?php endforeach; ?>
            <?php else: ?>
                <p>কোনো তথ্য পাওয়া যায়নি।</p>
            <?php endif; ?>
        </div> 
    </div>
</div>
<?= $this->endSection() ?>
