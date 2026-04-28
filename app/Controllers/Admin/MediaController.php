<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class MediaController extends BaseController
{
    public function index()
    {
        return view('admin/media/index', [
            'title' => 'Media Library'
        ]);
    }

    public function list()
    {
        $path = ROOTPATH . 'public/uploads';
        $files = [];
        
        if (is_dir($path)) {
            $dir = opendir($path);
            while (($file = readdir($dir)) !== false) {
                if ($file != "." && $file != ".." && !is_dir($path . '/' . $file)) {
                    $files[] = [
                        'name' => $file,
                        'url' => base_url('uploads/' . $file),
                        'time' => filemtime($path . '/' . $file)
                    ];
                }
            }
            closedir($dir);
        }

        // Sort by newest first
        usort($files, function($a, $b) {
            return $b['time'] - $a['time'];
        });

        return $this->response->setJSON($files);
    }

    public function uploadImage()
    {
        $file = $this->request->getFile('file') ?: $this->request->getFile('image');
        
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['error' => $file ? $file->getErrorString() : 'No file uploaded'])->setStatusCode(400);
        }

        if (!$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            
            return $this->response->setJSON([
                'success' => 1,
                'location' => base_url('uploads/' . $newName),
                'file' => [
                    'url' => base_url('uploads/' . $newName)
                ]
            ]);
        }

        return $this->response->setJSON(['error' => 'Could not move file'])->setStatusCode(500);
    }
}

