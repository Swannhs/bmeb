<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FullRestoreSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Clear existing menus and pages
        $db->table('menus')->emptyTable();
        $db->table('cms_pages')->emptyTable();
        
        // 2. Define the full menu structure (restored from original MenuSeeder)
        $menuData = [
            ['label' => 'হোম', 'url' => '/', 'order' => 1, 'color' => '#FF4500'],
            ['label' => 'আমাদের সম্পর্কে', 'url' => '#', 'order' => 2, 'color' => '#FF1493', 'children' => [
                ['label' => 'ইতিহাস', 'url' => '/p/691997bf933eb65569ddec81'],
                ['label' => 'বোর্ডের কার্যাবলি', 'url' => '/p/691997c8933eb65569ddf224'],
                ['label' => 'আইন ও বিধিসমুহ', 'url' => '/p/691997cd933eb65569ddf41b'],
                ['label' => 'সাংগঠনিক কাঠামো', 'url' => '/p/691997d6933eb65569ddf895'],
                ['label' => 'কর্মকর্তাবৃন্দ', 'url' => '/pages/officers'],
            ]],
            ['label' => 'কার্যক্রম', 'url' => '#', 'order' => 3, 'color' => '#00BFFF', 'children' => [
                ['label' => 'বার্ষিক ক্রয় পরিকল্পনা', 'url' => '/p/691997b1933eb65569dde140'],
                ['label' => 'ই-ফাইলিং কার্যক্রম', 'url' => '/p/691997bd933eb65569ddeb2d'],
                ['label' => 'বাল্য বিবাহ রোধ কার্যক্রম', 'url' => '/p/691997bd933eb65569ddeb2d'],
            ]],
            ['label' => 'ফর্ম সমূহ', 'url' => '#', 'order' => 4, 'color' => '#32CD32', 'children' => [
                ['label' => 'মঞ্জুরী শাখার ফরম', 'url' => '#', 'children' => [
                    ['label' => 'মঞ্জুরী শাখার অঙ্গীকার নামার নমুনা ফরম', 'url' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/f5a8024a5a824fafbfe536367048dba6.pdf', 'target' => '_blank'],
                    ['label' => 'পরিদর্শন ছক (দাখিল স্তরে পাঠদান)', 'url' => '/p/699ec1290517136ccaa3ad2e'],
                    ['label' => 'পরিদর্শন ছক (দাখিল একাডেমিক স্বীকৃতি)', 'url' => '/p/699ec1b2984807d0b829c7c6'],
                    ['label' => 'পরিদর্শন ছক (দাখিল মাদ্রাসা স্থাপন)', 'url' => '/p/699ec2403f04ce6e0241bc14'],
                ]],
                ['label' => 'প্রধান পরীক্ষক, পরীক্ষক ও নিরীক্ষক', 'url' => '#'],
            ]],
            ['label' => 'রেজাল্ট আর্কাইভ', 'url' => 'http://www.educationboardresults.gov.bd/', 'order' => 5, 'color' => '#1E90FF', 'target' => '_blank'],
            ['label' => 'প্রতিবেদন', 'url' => '#', 'order' => 6, 'color' => '#FF69B4', 'children' => [
                ['label' => 'অনুমোদিত কমিটি', 'url' => '/p/691997bd933eb65569ddeb2d'],
                ['label' => 'স্বীকৃতি নবায়ন হালনাগাদ তথ্য', 'url' => '/p/691997bd933eb65569ddeb2d'],
            ]],
            ['label' => 'পুরাতন ওয়েবসাইট', 'url' => 'http://bmeb.ebmeb.gov.bd/', 'order' => 7, 'color' => '#00CED1', 'target' => '_blank'],
            ['label' => 'যোগাযোগ', 'url' => '/p/691997ad933eb65569ddddf3', 'order' => 8, 'color' => '#8A2BE2'],
            ['label' => 'জুলাই পুনর্জাগরণ...', 'url' => '/p/691997b6933eb65569dde558', 'order' => 9, 'color' => '#FFA500'],
        ];

        $this->insertMenus($menuData);

        // 3. Ensure all pages exist
        $this->ensurePagesExist($menuData);
    }

    private function insertMenus($menus, $parentId = null)
    {
        $db = \Config\Database::connect();
        foreach ($menus as $index => $menu) {
            $data = [
                'parent_id' => $parentId,
                'label'     => $menu['label'],
                'url'       => $menu['url'],
                'order'     => $menu['order'] ?? ($index + 1),
                'color'     => $menu['color'] ?? null,
                'target'    => $menu['target'] ?? '_self',
                'is_active' => 1,
            ];
            $db->table('menus')->insert($data);
            $newId = $db->insertID();

            if (isset($menu['children'])) {
                $this->insertMenus($menu['children'], $newId);
            }
        }
    }

    private function ensurePagesExist($menus)
    {
        $db = \Config\Database::connect();
        foreach ($menus as $menu) {
            if (str_starts_with($menu['url'], '/p/')) {
                $slug = str_replace('/p/', '', $menu['url']);
                $existing = $db->table('cms_pages')->where('slug', $slug)->orWhere('route_key', $slug)->get()->getRow();
                
                if (!$existing) {
                    $db->table('cms_pages')->insert([
                        'slug'         => $slug,
                        'route_key'    => $slug,
                        'title'        => $menu['label'],
                        'html_content' => '
                            <p>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড (বিএমইবি) দেশের মাদ্রাসা শিক্ষা ব্যবস্থার উন্নয়ন ও আধুনিকায়নে নিরলসভাবে কাজ করে যাচ্ছে। এই পৃষ্ঠায় আপনি ' . $menu['label'] . ' সংক্রান্ত বিস্তারিত তথ্য পাবেন।</p>
                            <h2>আমাদের ভিশন</h2>
                            <p>আধুনিক ও ধর্মীয় শিক্ষার সমন্বয়ে একটি জ্ঞানভিত্তিক মাদ্রাসা শিক্ষা ব্যবস্থা গড়ে তোলা।</p>
                            <h2>আমাদের লক্ষ্য</h2>
                            <ul>
                                <li>শিক্ষার গুণগত মান নিশ্চিত করা।</li>
                                <li>আধুনিক প্রযুক্তির ব্যবহার বাড়ানো।</li>
                                <li>শিক্ষার্থীদের নৈতিক ও পেশাগত উন্নয়ন।</li>
                            </ul>
                            <p>আরও তথ্যের জন্য আমাদের সাথে যোগাযোগ করুন।</p>
                        ',
                        'source_type'  => 'native',
                        'status'       => 'published',
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ]);
                }
            }

            if (isset($menu['children'])) {
                $this->ensurePagesExist($menu['children']);
            }
        }
    }
}
