<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\PendaftaranModel;

class AdminDashboard extends BaseController
{
    public function index(): string
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $paketModel = new PaketModel();
        $pendaftaranModel = new PendaftaranModel();

        $data = [
            'total_paket' => $paketModel->countAll(),
            'total_pendaftaran' => $pendaftaranModel->countAll(),
            'pendaftaran_terbaru' => $pendaftaranModel
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->findAll(),
        ];

        return view('admin/dashboard', $data);
    }
}