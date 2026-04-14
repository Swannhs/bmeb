<?php

namespace App\Database\Seeds;

use App\Libraries\CmsPageService;
use App\Models\CmsPageModel;
use CodeIgniter\Database\Seeder;

class MirrorPageSeeder extends Seeder
{
    public function run()
    {
        $pages = new CmsPageModel();

        if ($pages->countAllResults() > 0) {
            return;
        }

        (new CmsPageService())->importMirrorPages();
    }
}
