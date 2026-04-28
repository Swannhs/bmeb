<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuUpdateSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $db->table('menus')->emptyTable();

        $data = [
            // Root Menus
            [
                'id' => 1,
                'parent_id' => null,
                'label' => 'হোম',
                'url' => '/',
                'order' => 1,
                'color' => '#FF4500',
                'target' => '_self',
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'label' => 'আমাদের সম্পর্কে',
                'url' => '#',
                'order' => 2,
                'color' => '#FF1493',
                'target' => '_self',
                'is_active' => 1,
            ],
            [
                'id' => 3,
                'parent_id' => 2,
                'label' => 'বোর্ড সম্পর্কে',
                'url' => '/p/about-board',
                'order' => 1,
                'color' => null,
                'target' => '_self',
                'is_active' => 1,
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'label' => 'সিটিজেন চার্টার',
                'url' => '/p/citizen-charter',
                'order' => 2,
                'color' => null,
                'target' => '_self',
                'is_active' => 1,
            ],
            [
                'id' => 5,
                'parent_id' => null,
                'label' => 'নোটিশ বোর্ড',
                'url' => '/pages/notices',
                'order' => 3,
                'color' => '#00BFFF',
                'target' => '_self',
                'is_active' => 1,
            ],
            [
                'id' => 6,
                'parent_id' => null,
                'label' => 'কর্মকর্তাবৃন্দ',
                'url' => '/pages/officers',
                'order' => 4,
                'color' => '#32CD32',
                'target' => '_self',
                'is_active' => 1,
            ],
            [
                'id' => 7,
                'parent_id' => null,
                'label' => 'যোগাযোগ',
                'url' => '/p/contact-us',
                'order' => 5,
                'color' => '#1E90FF',
                'target' => '_self',
                'is_active' => 1,
            ],
        ];

        $db->table('menus')->insertBatch($data);
    }
}
