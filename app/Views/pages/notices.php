<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>সকল নোটিশ | বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div data-section_type="body" class="droppable">
    <div data-widget_type="widget" data-widget_name="ContentBrowseWidget" class="widget content-browse-widget"> 
        <div class="title-bar"> 
            <div> <h2>সকল নোটিশ</h2> </div> 
        </div> 
        
        <div class="container-group"> 
            <div class="searchbar"> 
                <input type="text" name="search" id="search" placeholder="অনুসন্ধান" /> 
                <button id="search-btn"><i class="ph ph-magnifying-glass"></i></button> 
            </div> 
        </div> 

        <div class="browse-items view-type-list"> 
            <table class="table table-bordered notice-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">ক্রমিক</th>
                        <th>শিরোনাম</th>
                        <th style="width: 150px;">প্রকাশের তারিখ</th>
                        <th style="width: 100px;">ডাউনলোড</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notices)): ?>
                        <?php foreach ($notices as $index => $notice): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><a href="<?= site_url('pages/notices/' . $notice['id']) ?>"><?= $notice['title'] ?></a></td>
                            <td><?= date('d-m-Y', strtotime($notice['publish_date'])) ?></td>
                            <td>
                                <?php if (!empty($notice['file_path'])): ?>
                                <a href="<?= $notice['file_path'] ?>" target="_blank" class="download-link"><i class="ph ph-file-pdf"></i> PDF</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">কোন নোটিশ পাওয়া যায়নি</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>

<style>
.notice-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.notice-table th, .notice-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}
.notice-table th {
    background-color: #f4f4f4;
    font-weight: bold;
}
.download-link {
    color: #d32f2f;
    text-decoration: none;
    font-weight: bold;
}
</style>
<?= $this->endSection() ?>
