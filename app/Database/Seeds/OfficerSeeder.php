<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OfficerSeeder extends Seeder
{
    public function run()
    {
        $htmlFile = ROOTPATH . 'public/pages/officers.html';
        if (!file_exists($htmlFile)) {
            return;
        }

        $html = file_get_contents($htmlFile);
        
        // Find all employee blocks
        preg_match_all('/<div class="widget employee-content-widget">(.*?)<\/div>\s*<\/div>\s*<\/div>/is', $html, $matches);

        $this->db->table('officers')->truncate();

        $data = [];
        foreach ($matches[1] as $block) {
            $officer = [];
            
            // Name
            if (preg_match('/<td>নাম<\/td>\s*<td>(.*?)<\/td>/u', $block, $m)) {
                $officer['name'] = trim($m[1]);
            }
            
            // Designation
            if (preg_match('/<rt-renderer[^>]*>(.*?)<\/rt-renderer>/u', $block, $m)) {
                $officer['designation'] = trim($m[1]);
            }
            
            // Office
            if (preg_match('/<td>অফিস<\/td>\s*<td>(.*?)<\/td>/u', $block, $m)) {
                $officer['office'] = trim($m[1]);
            }
            
            // Email
            if (preg_match('/<td>ইমেইল<\/td>\s*<td>(.*?)<\/td>/u', $block, $m)) {
                // Email often has <wbr>
                $officer['email'] = trim(str_replace('<wbr>', '', $m[1]));
            }
            
            // Phone (Office)
            if (preg_match('/<td>ফোন \(অফিস\)<\/td>\s*<td>(.*?)<\/td>/u', $block, $m)) {
                $officer['phone_office'] = trim($m[1]);
            }
            
            // Mobile
            if (preg_match('/<td>মোবাইল<\/td>\s*<td>(.*?)<\/td>/u', $block, $m)) {
                $officer['mobile'] = trim($m[1]);
            }
            
            // Photo URL
            if (preg_match('/<img\s+src="(.*?)"/u', $block, $m)) {
                $officer['photo_url'] = trim($m[1]);
            }

            if (!empty($officer['name'])) {
                $data[] = $officer;
            }
        }

        if (!empty($data)) {
            $this->db->table('officers')->insertBatch($data);
        }
    }
}
