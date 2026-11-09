<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminAuth extends BaseController
{
    public function login(): string
    {
        return view('admin/login');
    }

    public function prosesLogin()
    {
        $adminModel = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $adminModel->where('username', $username)->first();

        if (!$admin || !password_verify($password, $admin['password'])) {
            return redirect()->to('/admin/login')->with('error', 'Username atau password salah.');
        }

        session()->set([
            'admin_id' => $admin['id'],
            'admin_username' => $admin['username'],
            'isAdminLoggedIn' => true,
        ]);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->remove(['admin_id', 'admin_username', 'isAdminLoggedIn']);
        return redirect()->to('/admin/login');
    }
}