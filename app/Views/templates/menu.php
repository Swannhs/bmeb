<?php
$uri = service('uri');
$currentPath = $uri->getPath();

function isActive($path, $currentPath) {
    if ($path === '/' && ($currentPath === '' || $currentPath === '/')) return 'active';
    return (str_contains($currentPath, $path)) ? 'active' : '';
}
?>
<section data-widget_type="widget" data-widget_name="MenusExpandableWidget" class="widget menus-expandable-widget max-view">
    <div class="menus-widget-container" style="--home-label:'হোম';">
        <section class="widget menu-widget">
            <span id="menu-toggle" class="hamburger-menu-block">
                <icon class="hamburger-menu ph ph-list"></icon> <span>মেনু নির্বাচন করুন</span>
            </span>
            <ul class="menu-list menu-parent-unordered-list custom-items-center" style="max-width: 85%;">
                <!-- Home -->
                <li class="megamenu-link <?= isActive('/', $currentPath) ?>" style="display: flex;">
                    <a class="menu-parent-list-link home-link" href="<?= base_url() ?>" style="color: rgb(255, 69, 0);"> </a>
                </li>

                <!-- আমাদের সম্পর্কে -->
                <li class="megamenu-link menu-parent-list" style="display: flex;">
                    <a title=" আমাদের সম্পর্কে" href="#" class="menu-parent-list-link" style="color: rgb(255, 20, 147);"> 
                        আমাদের সম্পর্কে <icon class="menu-parent-list-link-icon ph ph-caret-double-down"></icon> 
                    </a>
                    <div class="mega-menu-dropdown megaMenu" style="border-top: 6px solid rgb(255, 20, 147);">
                        <div class="menu-child-box ">
                            <ul class="menu-sub-child-unordered-list">
                                <li class="menu-sub-child-list">
                                    <a title=" ইতিহাস" class="menu-sub-child-link" href="<?= base_url('p/691997bf933eb65569ddec81') ?>">
                                        <div>ইতিহাস</div>
                                    </a>
                                </li>
                                <li class="menu-sub-child-list">
                                    <a title=" বোর্ডের কার্যাবলি" class="menu-sub-child-link" href="<?= base_url('p/691997c8933eb65569ddf224') ?>">
                                        <div>বোর্ডের কার্যাবলি</div>
                                    </a>
                                </li>
                                <li class="menu-sub-child-list">
                                    <a title=" আইন ও বিধিসমুহ" class="menu-sub-child-link" href="<?= base_url('p/691997cd933eb65569ddf41b') ?>">
                                        <div>আইন ও বিধিসমুহ</div>
                                    </a>
                                </li>
                                <li class="menu-sub-child-list">
                                    <a title=" সাংগঠনিক কাঠামো" class="menu-sub-child-link" href="<?= base_url('p/691997d6933eb65569ddf895') ?>">
                                        <div>সাংগঠনিক কাঠামো</div>
                                    </a>
                                </li>
                                <li class="menu-sub-child-list">
                                    <a title=" কর্মকর্তাবৃন্দ" class="menu-sub-child-link" href="<?= base_url('pages/officers') ?>">
                                        <div>কর্মকর্তাবৃন্দ</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- কার্যক্রম -->
                <li class="megamenu-link menu-parent-list" style="display: flex;">
                    <a title=" কার্যক্রম" href="#" class="menu-parent-list-link" style="color: rgb(0, 191, 255);"> 
                        কার্যক্রম <icon class="menu-parent-list-link-icon ph ph-caret-double-down"></icon> 
                    </a>
                    <div class="mega-menu-dropdown megaMenu" style="border-top: 6px solid rgb(0, 191, 255);">
                        <div class="menu-child-box ">
                            <ul class="menu-sub-child-unordered-list">
                                <li class="menu-sub-child-list">
                                    <a title=" বার্ষিক ক্রয় পরিকল্পনা" class="menu-sub-child-link" href="<?= base_url('p/691997b1933eb65569dde140') ?>">
                                        <div>বার্ষিক ক্রয় পরিকল্পনা</div>
                                    </a>
                                </li>
                                <li class="menu-sub-child-list">
                                    <a title=" ই-ফাইলিং কার্যক্রম" class="menu-sub-child-link" href="<?= base_url('p/691997bd933eb65569ddeb2d') ?>">
                                        <div>ই-ফাইলিং কার্যক্রম</div>
                                    </a>
                                </li>
                                <li class="menu-sub-child-list">
                                    <a title=" বাল্য বিবাহ রোধ কার্যক্রম" class="menu-sub-child-link" href="<?= base_url('p/691997bd933eb65569ddeb2d') ?>">
                                        <div>বাল্য বিবাহ রোধ কার্যক্রম</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- ফর্ম সমূহ -->
                <li class="megamenu-link menu-parent-list" style="display: flex;">
                    <a title=" ফর্ম সমূহ" href="#" class="menu-parent-list-link" style="color: rgb(50, 205, 50);"> 
                        ফর্ম সমূহ <icon class="menu-parent-list-link-icon ph ph-caret-double-down"></icon> 
                    </a>
                    <div class="mega-menu-dropdown megaMenu" style="border-top: 6px solid rgb(50, 205, 50);">
                        <div class="menu-child-box ">
                            <h6 title=" মঞ্জুরী শাখার ফরম" class="menu-child-title"> মঞ্জুরী শাখার ফরম </h6>
                            <ul class="menu-sub-child-unordered-list">
                                <li class="menu-sub-child-list"><a title=" মঞ্জুরী শাখার অঙ্গীকার নামার নমুনা ফরম" class="menu-sub-child-link" href="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/f5a8024a5a824fafbfe536367048dba6.pdf" target="_blank"><div>মঞ্জুরী শাখার অঙ্গীকার নামার নমুনা ফরম</div></a></li>
                                <li class="menu-sub-child-list"><a title=" পরিদর্শন ছক (দাখিল স্তরে পাঠদান)" class="menu-sub-child-link" href="<?= base_url('p/699ec1290517136ccaa3ad2e') ?>"><div>পরিদর্শন ছক (দাখিল স্তরে পাঠদান)</div></a></li>
                                <li class="menu-sub-child-list"><a title=" পরিদর্শন ছক (দাখিল একাডেমিক স্বীকৃতি)" class="menu-sub-child-link" href="<?= base_url('p/699ec1b2984807d0b829c7c6') ?>"><div>পরিদর্শন ছক (দাখিল একাডেমিক স্বীকৃতি)</div></a></li>
                                <li class="menu-sub-child-list"><a title=" পরিদর্শন ছক (দাখিল মাদ্রাসা স্থাপন)" class="menu-sub-child-link" href="<?= base_url('p/699ec2403f04ce6e0241bc14') ?>"><div>পরিদর্শন ছক (দাখিল মাদ্রাসা স্থাপন)</div></a></li>
                            </ul>
                        </div>
                        <div class="menu-child-box ">
                            <h6 title=" প্রধান পরীক্ষক, পরীক্ষক ও নিরীক্ষক সংক্রান্ত" class="menu-child-title"> প্রধান পরীক্ষক, পরীক্ষক ও নিরীক্ষক </h6>
                            <ul class="menu-sub-child-unordered-list">
                                <li class="menu-sub-child-list"><a title=" নিরীক্ষকের তথ্য ফর্ম" class="menu-sub-child-link" href="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/aaba3f7e96b3493da287657495e1a58b.pdf" target="_blank"><div>নিরীক্ষকের তথ্য ফর্ম</div></a></li>
                                <li class="menu-sub-child-list"><a title=" আলিম বিজ্ঞান ব্যবহারিক পরীক্ষার্থী এবং এক্সটারনাল-ইন্টারনাল শিক্ষকদের তথ্য ছক" class="menu-sub-child-link" href="https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/174f187d0423419d89ff3dd0eb01a508.pdf" target="_blank"><div>আলিম বিজ্ঞান ব্যবহারিক শিক্ষকদের তথ্য ছক</div></a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- রেজাল্ট আর্কাইভ -->
                <li class="megamenu-link menu-parent-list" style="display: flex;">
                    <a title=" রেজাল্ট আর্কাইভ" href="http://www.educationboardresults.gov.bd/" class="menu-parent-list-link" target="_blank" style="color: rgb(30, 144, 255);"> রেজাল্ট আর্কাইভ </a>
                </li>

                <!-- প্রতিবেদন -->
                <li class="megamenu-link menu-parent-list" style="display: flex;">
                    <a title=" প্রতিবেদন" href="#" class="menu-parent-list-link" style="color: rgb(255, 105, 180);"> 
                        প্রতিবেদন <icon class="menu-parent-list-link-icon ph ph-caret-double-down"></icon> 
                    </a>
                    <div class="mega-menu-dropdown megaMenu" style="border-top: 6px solid rgb(255, 105, 180);">
                        <div class="menu-child-box ">
                            <ul class="menu-sub-child-unordered-list">
                                <li class="menu-sub-child-list"><a title=" অনুমোদিত কমিটি" class="menu-sub-child-link" href="<?= base_url('p/691997bd933eb65569ddeb2d') ?>"><div>অনুমোদিত কমিটি</div></a></li>
                                <li class="menu-sub-child-list"><a title=" স্বীকৃতি নবায়ন হালনাগাদ তথ্য" class="menu-sub-child-link" href="<?= base_url('p/691997bd933eb65569ddeb2d') ?>"><div>স্বীকৃতি নবায়ন হালনাগাদ তথ্য</div></a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- পুরাতন ওয়েবসাইট -->
                <li class="megamenu-link menu-parent-list" style="display: flex;">
                    <a title=" পুরাতন ওয়েবসাইট" href="http://bmeb.ebmeb.gov.bd/" class="menu-parent-list-link" target="_blank" style="color: rgb(0, 206, 209);"> পুরাতন ওয়েবসাইট </a>
                </li>

                <!-- যোগাযোগ -->
                <li class="megamenu-link menu-parent-list force-extra" style="display: flex;">
                    <a title=" যোগাযোগ" href="<?= base_url('p/691997ad933eb65569ddddf3') ?>" class="menu-parent-list-link" style="color: rgb(138, 43, 226);"> যোগাযোগ </a>
                </li>

                <!-- জুলাই পুনর্জাগরণ... -->
                <li class="megamenu-link menu-parent-list force-extra" style="display: flex;">
                    <a title=" জুলাই পুনর্জাগরণ অনুষ্ঠানমালার টিভিসি/ভিডিও/ডকুমেন্টারি" href="<?= base_url('p/691997b6933eb65569dde558') ?>" class="menu-parent-list-link" style="color: rgb(255, 165, 0);"> 
                        জুলাই পুনর্জাগরণ... 
                    </a>
                </li>
            </ul>
        </section>
    </div>
    <div class="expand-btn">
        <span><i class="ph ph-list"></i> আরও</span>
        <span style="display:none;"><i class="ph ph-caret-up"></i> সংক্ষিপ্ত</span>
    </div>
</section>
