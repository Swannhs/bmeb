<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LinkSanitizerSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Sanitize cms_pages
        $pages = $db->table('cms_pages')->get()->getResultArray();
        foreach ($pages as $page) {
            $content = $this->sanitizeHtml($page['html_content']);
            $db->table('cms_pages')->where('id', $page['id'])->update(['html_content' => $content]);
        }
        
        // 2. Sanitize notices
        $notices = $db->table('notices')->get()->getResultArray();
        foreach ($notices as $notice) {
            $content = $this->sanitizeHtml($notice['content']);
            $db->table('notices')->where('id', $notice['id'])->update(['content' => $content]);
        }
    }

    private function sanitizeHtml(string $content): string
    {
        // Replace something.html with something
        // AND convert pages/static-pages/ to p/
        
        $content = preg_replace_callback(
            '/href="([^"]+)\.html(#?.*)?"/i',
            function ($matches) {
                $url = $matches[1];
                $anchor = $matches[2] ?? '';
                
                if (preg_match('/^[a-z]+:\/\//i', $url)) return $matches[0];
                
                if (basename($url) === 'index') return 'href="' . base_url() . $anchor . '"';
                
                $url = str_replace('../', '', $url);
                $url = ltrim($url, '/');
                
                // Shorten pages/static-pages/ to p/
                $url = str_replace('pages/static-pages/', 'p/', $url);
                
                return 'href="' . base_url($url . $anchor) . '"';
            },
            $content
        );
        
        $content = str_replace('.html', '', $content);
        // Shorten pages/static-pages/ to p/ globally
        $content = str_replace('pages/static-pages/', 'p/', $content);
        
        // Image fixes
        $content = preg_replace_callback(
            '/src="(?![a-z]+:\/\/)([^"]+)"/i',
            function ($matches) {
                $path = ltrim($matches[1], '/');
                $path = str_replace('../', '', $path);
                return 'src="' . base_url($path) . '"';
            },
            $content
        );

        return $content;
    }
}
