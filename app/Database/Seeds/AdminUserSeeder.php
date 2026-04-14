<?php

namespace App\Database\Seeds;

use App\Models\AdminUserModel;
use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $users = new AdminUserModel();

        if ($users->countAllResults() > 0) {
            return;
        }

        $name = getenv('CMS_ADMIN_NAME') ?: 'BMEB Admin';
        $email = getenv('CMS_ADMIN_EMAIL') ?: 'admin@bmeb.local';
        $password = getenv('CMS_ADMIN_PASSWORD') ?: 'admin123456';

        $users->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'is_active'     => 1,
        ]);
    }
}
