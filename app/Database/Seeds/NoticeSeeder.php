<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoticeSeeder extends Seeder
{
    public function run()
    {
        // Simple way to clear the table first
        $this->db->table('notices')->truncate();

        $data = [
            [
                'title'        => 'সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে',
                'slug'         => 'sylhet-meeting-time-change',
                'publish_date' => '2026-04-13',
                'is_new'       => 1,
                'category'     => 'সাধারণ',
                'content'      => 'সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে বিস্তারিত নোটিশ...',
                'file_path'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2026/1/notice1.pdf'
            ],
            [
                'title'        => '২৭.০৪.২০২৬ তারিখে অনুষ্ঠিতব্য আপিল ও সালিশ কমিটির সভায় উপস্থিত হওয়ার পত্র',
                'slug'         => 'appeal-committee-meeting-notice',
                'publish_date' => '2026-04-13',
                'is_new'       => 1,
                'category'     => 'সাধারণ',
                'content'      => 'আপিল ও সালিশ কমিটির সভায় উপস্থিত হওয়ার পত্র বিস্তারিত...',
                'file_path'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2026/1/notice2.pdf'
            ],
            [
                'title'        => '২০২৬ সালের ৬ষ্ঠ শ্রেণির রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন প্রসঙ্গে।',
                'slug'         => 'class-six-registration-2026',
                'publish_date' => '2026-04-13',
                'is_new'       => 1,
                'category'     => 'সাধারণ',
                'content'      => '২০২৬ সালের ৬ষ্ঠ শ্রেণির রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন প্রসঙ্গে বিস্তারিত...',
                'file_path'    => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2026/1/notice3.pdf'
            ],
            [
                'title'        => '২০২৫ সালের আলিম পরীক্ষার নম্বরপত্র প্রদান প্রসঙ্গে',
                'slug'         => 'alim-result-2025',
                'publish_date' => '2026-04-10',
                'is_new'       => 0,
                'category'     => 'পরীক্ষা',
                'content'      => 'বিস্তারিত তথ্য...',
                'file_path'    => '#'
            ],
            [
                'title'        => 'ইবতেদায়ি সমাপনী পরীক্ষা ২০২৬ এর নির্দেশিকা',
                'slug'         => 'ebtedayi-2026-guideline',
                'publish_date' => '2026-04-05',
                'is_new'       => 0,
                'category'     => 'পরীক্ষা',
                'content'      => 'বিস্তারিত তথ্য...',
                'file_path'    => '#'
            ],
        ];

        // Using Query Builder
        $this->db->table('notices')->insertBatch($data);
    }
}
