<?php

namespace App\Controllers;

use App\Models\PaketModel;

class Paket extends BaseController
{
    public function index(): string
    {
        $paketModel = new PaketModel();
        $data['paket'] = $paketModel->findAll();

        return view('paket', $data);
    }

    public function bandingkan(): string
{
    $paketModel = new \App\Models\PaketModel();

    $idA = $this->request->getGet('a');
    $idB = $this->request->getGet('b');

    $semuaPaket = $paketModel->findAll();
    $paketA = $paketModel->find($idA);
    $paketB = $paketModel->find($idB);

    return view('paket-bandingkan', [
        'semuaPaket' => $semuaPaket,
        'paketA' => $paketA,
        'paketB' => $paketB,
    ]);
}
}

