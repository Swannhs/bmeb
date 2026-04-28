<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class MenuController extends BaseController
{
    private $menus;

    public function __construct()
    {
        $this->menus = new MenuModel();
    }

    public function index()
    {
        return view('admin/menus/index', [
            'menus' => $this->menus->orderBy('order', 'ASC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('admin/menus/form', [
            'menu'    => null,
            'parents' => $this->menus->where('parent_id', null)->findAll(),
            'errors'  => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost();
        
        if ($this->menus->insert($data)) {
            return redirect()->to('/admin/menus')->with('message', 'Menu created.');
        }

        return redirect()->back()->withInput()->with('errors', $this->menus->errors());
    }

    public function edit($id)
    {
        $menu = $this->menus->find($id);
        if (!$menu) {
            return redirect()->to('/admin/menus')->with('error', 'Menu not found.');
        }

        return view('admin/menus/form', [
            'menu'    => $menu,
            'parents' => $this->menus->where('parent_id', null)->where('id !=', $id)->findAll(),
            'errors'  => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        
        if ($this->menus->update($id, $data)) {
            return redirect()->to('/admin/menus')->with('message', 'Menu updated.');
        }

        return redirect()->back()->withInput()->with('errors', $this->menus->errors());
    }

    public function delete($id)
    {
        $this->menus->delete($id);
        return redirect()->to('/admin/menus')->with('message', 'Menu deleted.');
    }

    public function reorder()
    {
        $order = $this->request->getPost('order');
        if (!is_array($order)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data']);
        }

        foreach ($order as $index => $id) {
            $this->menus->update($id, ['order' => $index + 1]);
        }

        return $this->response->setJSON(['status' => 'success']);
    }
}
