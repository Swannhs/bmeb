<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CleanPageSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('cms_pages')->truncate();

        $data = [
            [
                'route_key'    => 'about-us',
                'slug'         => 'about-board',
                'title'        => 'বোর্ড সম্পর্কে',
                'html_content' => '<h2>আমাদের ইতিহাস</h2><p>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড একটি স্বায়ত্তশাসিত প্রতিষ্ঠান যা মাদ্রাসা শিক্ষার মান নিয়ন্ত্রণ ও পরিচালনার জন্য দায়বদ্ধ।</p><h3>আমাদের লক্ষ্য</h3><p>মাদ্রাসা শিক্ষার আধুনিকায়ন ও গুনগত মান নিশ্চিত করা।</p>',
                'source_type'  => 'native',
                'status'       => 'published',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'route_key'    => 'contact',
                'slug'         => 'contact-us',
                'title'        => 'যোগাযোগ',
                'html_content' => '<p>আমাদের সাথে যোগাযোগের ঠিকানা:</p><address>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড<br>অরফানেজ রোড, বকশিবাজার, ঢাকা-১২১১।</address><p>ইমেইল: info@bmeb.gov.bd</p>',
                'source_type'  => 'native',
                'status'       => 'published',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'route_key'    => 'citizen-charter',
                'slug'         => 'citizen-charter',
                'title'        => 'সিটিজেন চার্টার',
                'html_content' => '<h2>সেবা প্রদানের অঙ্গীকার</h2><p>১. দ্রুততম সময়ে সার্টিফিকেট প্রদান।<br>২. নির্ভুল তথ্য পরিবেশন।</p>',
                'source_type'  => 'native',
                'status'       => 'published',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('cms_pages')->insertBatch($data);
    }
}
