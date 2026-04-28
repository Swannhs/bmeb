<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RealDummyDataSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Sliders
        $db->table('sliders')->emptyTable();
        $db->table('sliders')->insertBatch([
            [
                'image_url'  => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/918e335631dd45fdb5599a3d1eefc91f.jpg',
                'sort_order' => 1
            ],
            [
                'image_url'  => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/28d09723f54546419702334812f86236.jpg',
                'sort_order' => 2
            ]
        ]);

        // 2. Notices
        $db->table('notices')->emptyTable();
        $db->table('notices')->insertBatch([
            [
                'title'        => 'আলিম পরীক্ষা-২০২৬ এর কেন্দ্র কমিটি গঠন ও ভারপ্রাপ্ত কর্মকর্তার তথ্য ফরম পূরণ প্রসঙ্গে',
                'slug'         => 'alim-exam-2026-center-committee',
                'publish_date' => '2026-04-23',
                'file_path'    => '#',
                'content'      => '{"blocks":[{"type":"paragraph","data":{"text":"আলিম পরীক্ষা-২০২৬ এর কেন্দ্র কমিটি গঠন ও ভারপ্রাপ্ত কর্মকর্তার তথ্য ফরম পূরণ প্রসঙ্গে বিস্তারিত তথ্য নিচে দেওয়া হলো।"}}]}',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'আপিল ও সালিশ কমিটির সভা স্থগিত প্রসঙ্গে',
                'slug'         => 'appeal-arbitration-meeting-postponed',
                'publish_date' => '2026-04-22',
                'file_path'    => '#',
                'content'      => '{"blocks":[{"type":"paragraph","data":{"text":"অনিবার্য কারণবশত আপিল ও সালিশ কমিটির সভা স্থগিত করা হয়েছে।"}}]}',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'দাখিল ২০২৬ এর প্রাইভেট পরীক্ষার্থীর সিলেবাস',
                'slug'         => 'dakhil-2026-private-syllabus',
                'publish_date' => '2026-04-22',
                'file_path'    => '#',
                'content'      => '{"blocks":[{"type":"paragraph","data":{"text":"দাখিল ২০২৬ এর প্রাইভেট পরীক্ষার্থীদের জন্য নতুন সিলেবাস প্রকাশ করা হয়েছে।"}}]}',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ]);

        // 3. Officers
        $db->table('officers')->emptyTable();
        $db->table('officers')->insertBatch([
            [
                'name'         => 'প্রফেসর মিঞা মোঃ নূরুল হক',
                'designation'  => 'চেয়ারম্যান',
                'office'       => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                'email'        => 'chairman@bmeb.gov.bd',
                'phone_office' => '০২৫৮৬১০২১৬',
                'mobile'       => '০১৭১৩০০১২৩২',
                'photo_url'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/9e0ef9ab396b4f7e96b8602de11711c7.jpg',
                'sort_order'   => 1
            ],
            [
                'name'         => 'প্রফেসর ছালেহ আহমাদ',
                'designation'  => 'রেজিস্ট্রার',
                'office'       => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                'email'        => 'registrar@bmeb.gov.bd',
                'phone_office' => '০২৯৬১২৮৫৮',
                'mobile'       => '০১৩২৪৭২৭৩৬৫',
                'photo_url'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/5fb070181013449fa7bf026022af9229.jpg',
                'sort_order'   => 2
            ],
            [
                'name'         => 'প্রফেসর ড. মোহাম্মদ কামরুল আহসান',
                'designation'  => 'পরীক্ষা নিয়ন্ত্রক',
                'office'       => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                'email'        => 'controller@bmeb.gov.bd',
                'phone_office' => null,
                'mobile'       => null,
                'photo_url'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/36735e160a3d46779e3940192e42f61e.jpg',
                'sort_order'   => 3
            ],
            [
                'name'         => 'শরীফ মুহাম্মদ ইউনুছ',
                'designation'  => 'মাদ্রাসা পরিদর্শক (অতিরিক্ত দায়িত্ব)',
                'office'       => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                'email'        => null,
                'phone_office' => null,
                'mobile'       => null,
                'photo_url'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/75945ed361094056973685e13d9692c8.jpg',
                'sort_order'   => 4
            ]
        ]);
    }
}
