<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;

class AdminPendaftaran extends BaseController
{
    public function index()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $pendaftaranModel = new PendaftaranModel();

        $semua = $pendaftaranModel
            ->select('pendaftaran.*, paket.tipe_bayar, paket.kecepatan_judul, paket.harga as harga_paket')
            ->join('paket', 'paket.id = pendaftaran.paket_id', 'left')
            ->orderBy('pendaftaran.created_at', 'DESC')
            ->findAll();

        return view('admin/pendaftaran', ['semua' => $semua]);
    }

    public function updateStatus()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $pendaftaranModel = new PendaftaranModel();

        $id = $this->request->getPost('id');
        $statusBaru = $this->request->getPost('status');

        $pendaftaranModel->update($id, ['status' => $statusBaru]);

        return redirect()->to('/admin/pendaftaran')
            ->with('success', 'Status berhasil diubah.');
    }

    public function export()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $dari = $this->request->getGet('dari') ?: date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?: date('Y-m-d');

        $format = $this->request->getGet('format') === 'pdf'
            ? 'pdf'
            : 'excel';

        $data = array_map(
            fn($r) => (array) $r,
            (new PendaftaranModel())
                ->select('pendaftaran.*, paket.tipe_bayar, paket.kecepatan_judul, paket.harga as harga_paket')
                ->join('paket', 'paket.id = pendaftaran.paket_id', 'left')
                ->where('pendaftaran.created_at >=', $dari . ' 00:00:00')
                ->where('pendaftaran.created_at <=', $sampai . ' 23:59:59')
                ->orderBy('pendaftaran.created_at', 'DESC')
                ->findAll()
        );

        // Mengambil kolom tabel pendaftaran tanpa id, paket_id, dan user_id
        $db = \Config\Database::connect();

        $kolom = array_values(
            array_diff(
                $db->getFieldNames('pendaftaran'),
                ['id', 'paket_id', 'user_id']
            )
        );

        // Menambahkan informasi paket
        $kolom = array_merge(
            $kolom,
            ['tipe_bayar', 'kecepatan_judul', 'harga_paket']
        );

        // Mengatur nama kolom laporan
        $labelKhusus = [
            'no_registrasi'   => 'No. Registrasi',
            'no_hp'           => 'No. HP',
            'created_at'      => 'Tanggal Daftar',
            'tipe_bayar'      => 'Tipe Bayar',
            'kecepatan_judul' => 'Paket',
            'harga_paket'     => 'Harga Paket',
        ];

        $label = array_map(
            fn($k) => $labelKhusus[$k] ?? ucwords(str_replace('_', ' ', $k)),
            $kolom
        );

        $namaFile = 'laporan-pendaftaran-' . $dari . '_sd_' . $sampai;

        // ===== EXCEL =====
        if ($format === 'excel') {

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Pendaftaran');

            $sheet->setCellValue('A1', 'Laporan Pendaftaran IndiHome Depok');
            $sheet->setCellValue('A2', 'Periode: ' . $dari . ' s/d ' . $sampai);

            $sheet->getStyle('A1')->getFont()
                ->setBold(true)
                ->setSize(14);

            $tipeTeks = \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING;

            $col = fn($i) =>
                \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);

            // Menampilkan judul kolom Excel
            foreach ($label as $i => $teks) {
                $sheet->setCellValue($col($i + 1) . '4', $teks);
            }

            $sheet->getStyle('A4:' . $col(count($kolom)) . '4')
                ->getFont()
                ->setBold(true);

            // Mengisi data pendaftaran
            $r = 5;

            foreach ($data as $row) {
                foreach ($kolom as $i => $k) {
                    $sheet->setCellValueExplicit(
                        $col($i + 1) . $r,
                        (string) ($row[$k] ?? ''),
                        $tipeTeks
                    );
                }

                $r++;
            }

            // Menyesuaikan lebar kolom
            foreach (range(1, count($kolom)) as $i) {
                $sheet->getColumnDimensionByColumn($i)->setAutoSize(true);
            }

            ob_start();

            (new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet))
                ->save('php://output');

            $isi = ob_get_clean();

            return $this->response
                ->setHeader(
                    'Content-Type',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                )
                ->setHeader(
                    'Content-Disposition',
                    'attachment; filename="' . $namaFile . '.xlsx"'
                )
                ->setBody($isi);
        }

        // ===== PDF =====
        $ringkasan = [];

        if (in_array('status', $kolom)) {
            foreach ($data as $row) {
                $s = $row['status'] ?: '-';

                $ringkasan[$s] = ($ringkasan[$s] ?? 0) + 1;
            }
        }

        $html = view('laporan_pendaftaran_pdf', [
            'dari'      => $dari,
            'sampai'    => $sampai,
            'kolom'     => $kolom,
            'label'     => $label,
            'data'      => $data,
            'ringkasan' => $ringkasan,
        ]);

        $dompdf = new \Dompdf\Dompdf();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' . $namaFile . '.pdf"'
            )
            ->setBody($dompdf->output());
    }
}
