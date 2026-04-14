<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use App\Models\CmsPageModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $pages = new CmsPageModel();

        return view('admin/dashboard', [
            'totalPages'     => $pages->countAllResults(),
            'publishedPages' => $pages->where('status', 'published')->countAllResults(),
            'draftPages'     => $pages->where('status', 'draft')->countAllResults(),
            'totalAdmins'    => (new AdminUserModel())->countAllResults(),
        ]);
    }
}
