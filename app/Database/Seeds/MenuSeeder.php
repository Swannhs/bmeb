<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Home
            [
                'label'     => 'হোম',
                'url'       => '/',
                'order'     => 1,
                'color'     => '#FF4500',
                'parent_id' => null,
            ],
            // আমাদের সম্পর্কে
            [
                'label'     => 'আমাদের সম্পর্কে',
                'url'       => '#',
                'order'     => 2,
                'color'     => '#FF1493',
                'parent_id' => null,
            ],
            // কার্যাক্রম
            [
                'label'     => 'কার্যক্রম',
                'url'       => '#',
                'order'     => 3,
                'color'     => '#00BFFF',
                'parent_id' => null,
            ],
            // ফর্ম সমূহ
            [
                'label'     => 'ফর্ম সমূহ',
                'url'       => '#',
                'order'     => 4,
                'color'     => '#32CD32',
                'parent_id' => null,
            ],
            // রেজাল্ট আর্কাইভ
            [
                'label'     => 'রেজাল্ট আর্কাইভ',
                'url'       => 'http://www.educationboardresults.gov.bd/',
                'order'     => 5,
                'color'     => '#1E90FF',
                'parent_id' => null,
                'target'    => '_blank',
            ],
            // প্রতিবেদন
            [
                'label'     => 'প্রতিবেদন',
                'url'       => '#',
                'order'     => 6,
                'color'     => '#FF69B4',
                'parent_id' => null,
            ],
            // পুরাতন ওয়েবসাইট
            [
                'label'     => 'পুরাতন ওয়েবসাইট',
                'url'       => 'http://bmeb.ebmeb.gov.bd/',
                'order'     => 7,
                'color'     => '#00CED1',
                'parent_id' => null,
                'target'    => '_blank',
            ],
            // যোগাযোগ
            [
                'label'     => 'যোগাযোগ',
                'url'       => '/p/691997ad933eb65569ddddf3',
                'order'     => 8,
                'color'     => '#8A2BE2',
                'parent_id' => null,
            ],
            // জুলাই পুনর্জাগরণ...
            [
                'label'     => 'জুলাই পুনর্জাগরণ...',
                'url'       => '/p/691997b6933eb65569dde558',
                'order'     => 9,
                'color'     => '#FFA500',
                'parent_id' => null,
            ],
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('menus');

        foreach ($data as $item) {
            $existing = $builder->where('label', $item['label'])->where('url', $item['url'])->get()->getRow();
            if ($existing) {
                $parentId = $existing->id;
            } else {
                $builder->insert($item);
                $parentId = $db->insertID();
            }

            // Add children based on original menu
            if ($item['label'] === 'আমাদের সম্পর্কে') {
                $children = [
                    ['label' => 'ইতিহাস', 'url' => '/p/691997bf933eb65569ddec81'],
                    ['label' => 'বোর্ডের কার্যাবলি', 'url' => '/p/691997c8933eb65569ddf224'],
                    ['label' => 'আইন ও বিধিসমুহ', 'url' => '/p/691997cd933eb65569ddf41b'],
                    ['label' => 'সাংগঠনিক কাঠামো', 'url' => '/p/691997d6933eb65569ddf895'],
                    ['label' => 'কর্মকর্তাবৃন্দ', 'url' => '/pages/officers'],
                ];
                foreach ($children as $i => $child) {
                    $child['parent_id'] = $parentId;
                    $child['order'] = $i + 1;
                    $builder->insert($child);
                }
            } elseif ($item['label'] === 'কার্যক্রম') {
                $children = [
                    ['label' => 'বার্ষিক ক্রয় পরিকল্পনা', 'url' => '/p/691997b1933eb65569dde140'],
                    ['label' => 'ই-ফাইলিং কার্যক্রম', 'url' => '/p/691997bd933eb65569ddeb2d'],
                    ['label' => 'বাল্য বিবাহ রোধ কার্যক্রম', 'url' => '/p/691997bd933eb65569ddeb2d'],
                ];
                foreach ($children as $i => $child) {
                    $child['parent_id'] = $parentId;
                    $child['order'] = $i + 1;
                    $builder->insert($child);
                }
            } elseif ($item['label'] === 'ফর্ম সমূহ') {
                 // Forms has sections, maybe just add them as children for now
                 // or use a more complex structure later. 
                 // For now, let's just add the direct links.
                 $children = [
                    ['label' => 'মঞ্জুরী শাখার ফরম', 'url' => '#'],
                    ['label' => 'প্রধান পরীক্ষক, পরীক্ষক ও নিরীক্ষক', 'url' => '#'],
                 ];
                 foreach ($children as $i => $child) {
                     $child['parent_id'] = $parentId;
                     $child['order'] = $i + 1;
                     $builder->insert($child);
                     $subParentId = $db->insertID();
                     if ($child['label'] === 'মঞ্জুরী শাখার ফরম') {
                         $subChildren = [
                             ['label' => 'মঞ্জুরী শাখার অঙ্গীকার নামার নমুনা ফরম', 'url' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/f5a8024a5a824fafbfe536367048dba6.pdf', 'target' => '_blank'],
                             ['label' => 'পরিদর্শন ছক (দাখিল স্তরে পাঠদান)', 'url' => '/p/699ec1290517136ccaa3ad2e'],
                             ['label' => 'পরিদর্শন ছক (দাখিল একাডেমিক স্বীকৃতি)', 'url' => '/p/699ec1b2984807d0b829c7c6'],
                             ['label' => 'পরিদর্শন ছক (দাখিল মাদ্রাসা স্থাপন)', 'url' => '/p/699ec2403f04ce6e0241bc14'],
                         ];
                         foreach ($subChildren as $j => $sc) {
                             $sc['parent_id'] = $subParentId;
                             $sc['order'] = $j + 1;
                             $builder->insert($sc);
                         }
                     }
                 }
            } elseif ($item['label'] === 'প্রতিবেদন') {
                $children = [
                    ['label' => 'অনুমোদিত কমিটি', 'url' => '/p/691997bd933eb65569ddeb2d'],
                    ['label' => 'স্বীকৃতি নবায়ন হালনাগাদ তথ্য', 'url' => '/p/691997bd933eb65569ddeb2d'],
                ];
                foreach ($children as $i => $child) {
                    $child['parent_id'] = $parentId;
                    $child['order'] = $i + 1;
                    $builder->insert($child);
                }
            }
        }
    }
}
