<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    public function run()
    {
        $publicDir = ROOTPATH . 'public';
        $directory = new \RecursiveDirectoryIterator($publicDir);
        $iterator = new \RecursiveIteratorIterator($directory);
        
        $this->db->table('cms_pages')->truncate();
        
        $data = [];
        $factory = new \App\Libraries\MirroredDocumentFactory();
        
        foreach ($iterator as $info) {
            if ($info->isFile() && $info->getExtension() === 'html') {
                $filePath = $info->getPathname();
                $relativePath = str_replace($publicDir . DIRECTORY_SEPARATOR, '', $filePath);
                
                // Skip assets and index.html (already covered)
                if (str_starts_with($relativePath, 'site-assets') || 
                    str_starts_with($relativePath, 'widget-assets') || 
                    $relativePath === 'index.html' ||
                    $relativePath === 'index_en.html') {
                    continue;
                }
                
                $html = file_get_contents($filePath);
                $doc = $factory->fromHtml($html);
                
                // Construct a route key (e.g. static-pages/691997bf933eb65569ddec81)
                $routeKey = str_replace('.html', '', $relativePath);
                
                $data[] = [
                    'route_key'    => $routeKey,
                    'route_path'   => $relativePath,
                    'title'        => $doc['title'] ?? $routeKey,
                    'html_content' => $doc['mainContent'] ?? $doc['bodyContent'],
                    'source_path'  => $filePath,
                    'source_type'  => 'imported',
                    'created_at'   => date('Y-m-d H:i:s'),
                ];
                
                // Batch insert every 50 records to avoid memory issues
                if (count($data) >= 50) {
                    $this->db->table('cms_pages')->insertBatch($data);
                    $data = [];
                }
            }
        }
        
        if (!empty($data)) {
            $this->db->table('cms_pages')->insertBatch($data);
        }
    }
}
