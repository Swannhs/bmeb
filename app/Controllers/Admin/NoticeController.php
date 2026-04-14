<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NoticeModel;

class NoticeController extends BaseController
{
    private NoticeModel $notices;

    public function __construct()
    {
        $this->notices = new NoticeModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $query = $this->notices->orderBy('publish_date', 'DESC');
        
        if ($search !== '') {
            $query->like('title', $search);
        }
        
        return view('admin/notices/index', [
            'notices' => $query->paginate(20),
            'pager'   => $this->notices->pager,
            'search'  => $search,
        ]);
    }

    public function new()
    {
        return view('admin/notices/form', [
            'notice' => [
                'id' => null,
                'title' => '',
                'slug' => '',
                'content' => '',
                'publish_date' => date('Y-m-d'),
                'file_path' => '',
                'is_new' => 1,
                'category' => 'general'
            ]
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost(['title', 'slug', 'content', 'publish_date', 'file_path', 'is_new', 'category']);
        
        if ($this->notices->insert($data)) {
            return redirect()->to('/admin/notices')->with('success', 'Notice created successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create notice. ' . implode(', ', $this->notices->errors()));
    }

    public function edit(int $id)
    {
        $notice = $this->notices->find($id);
        
        if (!$notice) {
            return redirect()->to('/admin/notices')->with('error', 'Notice not found.');
        }

        return view('admin/notices/form', ['notice' => $notice]);
    }

    public function update(int $id)
    {
        $data = $this->request->getPost(['title', 'slug', 'content', 'publish_date', 'file_path', 'is_new', 'category']);
        
        if ($this->notices->update($id, $data)) {
            return redirect()->to('/admin/notices')->with('success', 'Notice updated successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update notice. ' . implode(', ', $this->notices->errors()));
    }

    public function delete(int $id)
    {
        if ($this->notices->delete($id)) {
            return redirect()->to('/admin/notices')->with('success', 'Notice deleted successfully.');
        }

        return redirect()->to('/admin/notices')->with('error', 'Failed to delete notice.');
    }
}
