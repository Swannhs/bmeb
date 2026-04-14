<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoticeSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $db->table('notices')->truncate();

        $data = [
            [
                'title'        => 'সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে',
                'slug'         => 'সিলেটের-মত-বিনিময়-সভার-সময়-পরিবর্তন-প্রসঙ্গে-dpr6bf-69dca3d442bf0963261ce02e',
                'publish_date' => '2026-04-13',
                'is_new'       => 1,
                'category'     => 'সাধারণ',
                'content'      => 'সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে বিস্তারিত নোটিশ...',
                'file_path'    => '#'
            ],
            [
                'title'        => '২০২৬ সালের ৬ষ্ঠ শ্রেণির রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন প্রসঙ্গে।',
                'slug'         => '২০২৬-সালের-৬ষ্ঠ-শ্রেণির-রেজিস্ট্রেশনের-ডাউনলোড-ও-সংশোধন-প্রসঙ্গে-0migxf-69dc77203f952c5bc756b697',
                'publish_date' => '2026-04-13',
                'is_new'       => 1,
                'category'     => 'সাধারণ',
                'content'      => 'রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন প্রসঙ্গে বিস্তারিত...',
                'file_path'    => '#'
            ],
        ];

        // Import more from static files but CLEAN the slugs
        $noticeDir = ROOTPATH . 'public/pages/notices';
        // Note: I renamed pages to pages_bak
        $noticeDir = ROOTPATH . 'public/pages_bak/notices';
        
        if (is_dir($noticeDir)) {
            $files = scandir($noticeDir);
            foreach ($files as $file) {
                if (str_ends_with($file, '.html')) {
                    $slug = str_replace('.html', '', $file);
                    
                    $exists = false;
                    foreach ($data as $d) {
                        if ($d['slug'] === $slug) { $exists = true; break; }
                    }
                    if ($exists) continue;

                    $data[] = [
                        'title'        => $slug,
                        'slug'         => $slug,
                        'publish_date' => date('Y-m-d'),
                        'is_new'       => 0,
                        'category'     => 'সাধারণ',
                        'content'      => 'Imported Content',
                        'file_path'    => '#'
                    ];
                }
            }
        }

        if (!empty($data)) {
            $db->table('notices')->insertBatch($data);
        }
    }
}
