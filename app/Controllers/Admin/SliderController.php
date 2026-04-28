<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SliderModel;

class SliderController extends BaseController
{
    public function index()
    {
        $sliderModel = new SliderModel();
        $data['sliders'] = $sliderModel->orderBy('sort_order', 'ASC')->findAll();
        $data['title'] = 'Manage Sliders';
        return view('admin/sliders/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {
            $sliderModel = new SliderModel();
            
            $data = [
                'image_url'  => $this->request->getPost('image_url'),
                'sort_order' => $this->request->getPost('sort_order') ?: 0,
            ];
            
            $sliderModel->insert($data);
            return redirect()->to('/admin/sliders')->with('success', 'Slider added successfully.');
        }
        
        $data['title'] = 'Add Slider';
        $data['slider'] = ['id' => null, 'image_url' => '', 'sort_order' => 0];
        return view('admin/sliders/form', $data);
    }

    public function edit($id)
    {
        $sliderModel = new SliderModel();
        $slider = $sliderModel->find($id);
        
        if (!$slider) {
            return redirect()->to('/admin/sliders')->with('error', 'Slider not found.');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'image_url'  => $this->request->getPost('image_url'),
                'sort_order' => $this->request->getPost('sort_order') ?: 0,
            ];
            
            $sliderModel->update($id, $data);
            return redirect()->to('/admin/sliders')->with('success', 'Slider updated successfully.');
        }

        $data['title'] = 'Edit Slider';
        $data['slider'] = $slider;
        return view('admin/sliders/form', $data);
    }

    public function delete($id)
    {
        $sliderModel = new SliderModel();
        if ($sliderModel->find($id)) {
            $sliderModel->delete($id);
            return redirect()->to('/admin/sliders')->with('success', 'Slider deleted successfully.');
        }
        return redirect()->to('/admin/sliders')->with('error', 'Slider not found.');
    }

    public function reorder()
    {
        $sliderModel = new SliderModel();
        $order = $this->request->getPost('order');
        
        if ($order) {
            foreach ($order as $index => $id) {
                $sliderModel->update($id, ['sort_order' => $index]);
            }
            return $this->response->setJSON(['success' => true]);
        }
        
        return $this->response->setJSON(['success' => false])->setStatusCode(400);
    }
}
