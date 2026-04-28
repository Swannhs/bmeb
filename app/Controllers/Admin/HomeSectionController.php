<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HomeSectionModel;

class HomeSectionController extends BaseController
{
    protected $sections;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->sections = new HomeSectionModel();
    }

    public function index()
    {
        return view('admin/home_sections/index', [
            'sections' => $this->sections->orderBy('sort_order', 'ASC')->findAll()
        ]);
    }


    public function edit(int $id)
    {
        $section = $this->sections->find($id);
        if (!$section) {
            return redirect()->to('/admin/home-sections')->with('error', 'Section not found');
        }

        return view('admin/home_sections/form', [
            'section' => $section
        ]);
    }

    public function update(int $id)
    {
        $section = $this->sections->find($id);
        if (!$section) {
            return redirect()->to('/admin/home-sections')->with('error', 'Section not found');
        }

        $data = $this->request->getPost();
        
        // Handle JSON content if it's a widget or list
        if (isset($data['json_content'])) {
            $data['content'] = $data['json_content'];
            unset($data['json_content']);
        }

        if ($this->sections->update($id, $data)) {
            return redirect()->to('/admin/home-sections')->with('message', 'Section updated successfully');
        }

        return redirect()->back()->withInput()->with('errors', $this->sections->errors());
    }

    public function reorder()
    {
        $orders = $this->request->getJSON(true);
        foreach ($orders as $order) {
            $this->sections->update($order['id'], ['sort_order' => $order['sort_order']]);
        }
        return $this->response->setJSON(['status' => 'success']);
    }
}
