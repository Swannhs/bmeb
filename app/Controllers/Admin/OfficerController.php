<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OfficerModel;

class OfficerController extends BaseController
{
    private OfficerModel $officers;

    public function __construct()
    {
        $this->officers = new OfficerModel();
    }

    public function index()
    {
        return view('admin/officers/index', [
            'officers' => $this->officers->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('admin/officers/form', [
            'officer' => [
                'id' => null,
                'name' => '',
                'designation' => '',
                'office' => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                'email' => '',
                'phone_office' => '',
                'mobile' => '',
                'photo_url' => '',
                'sort_order' => 0
            ]
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost(['name', 'designation', 'office', 'email', 'phone_office', 'mobile', 'photo_url', 'sort_order']);
        
        if ($this->officers->insert($data)) {
            return redirect()->to('/admin/officers')->with('success', 'Officer added successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add officer. ' . implode(', ', $this->officers->errors()));
    }

    public function edit(int $id)
    {
        $officer = $this->officers->find($id);
        
        if (!$officer) {
            return redirect()->to('/admin/officers')->with('error', 'Officer not found.');
        }

        return view('admin/officers/form', ['officer' => $officer]);
    }

    public function update(int $id)
    {
        $data = $this->request->getPost(['name', 'designation', 'office', 'email', 'phone_office', 'mobile', 'photo_url', 'sort_order']);
        
        if ($this->officers->update($id, $data)) {
            return redirect()->to('/admin/officers')->with('success', 'Officer updated successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update officer. ' . implode(', ', $this->officers->errors()));
    }

    public function delete(int $id)
    {
        if ($this->officers->delete($id)) {
            return redirect()->to('/admin/officers')->with('success', 'Officer deleted successfully.');
        }

        return redirect()->to('/admin/officers')->with('error', 'Failed to delete officer.');
    }
}
