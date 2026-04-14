<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->has('admin_user_id')) {
            return redirect()->to('/admin');
        }

        return view('admin/login', [
            'authless' => true,
            'error'    => session()->getFlashdata('error'),
        ]);
    }

    public function attemptLogin()
    {
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $user = (new AdminUserModel())
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();

        if ($user === null || ! password_verify($password, (string) $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        session()->set([
            'admin_user_id'    => $user['id'],
            'admin_user_name'  => $user['name'],
            'admin_user_email' => $user['email'],
        ]);

        return redirect()->to('/admin');
    }

    public function logout()
    {
        session()->remove(['admin_user_id', 'admin_user_name', 'admin_user_email']);

        return redirect()->to('/admin/login');
    }
}
