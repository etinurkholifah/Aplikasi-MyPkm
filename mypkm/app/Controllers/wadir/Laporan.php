<?php

namespace App\Controllers\Wadir;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\LaporanModel;
use Mpdf\Mpdf;
use Carbon\Carbon;


class Laporan extends BaseController
{
    protected $mahasiswa;
    protected $laporan;

    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
        $this->laporan = new LaporanModel();
    }

    public function index()
    {
        $data = [
            'dataLaporan' => $this->laporan->getAllData(),
            'page_title' => 'laporan'
        ];

        return view('wadir/laporan', $data);
    }

    public function export()
    {
        // Ambil data dari database
        $dataMahasiswa = $this->mahasiswa->findAll();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Tentukan path direktori tujuan
        $pdfDirectory = FCPATH . 'assets/file/laporan/';

        // Gantilah baris yang menghasilkan output PDF dengan:
        $pdfFileName = 'laporan_mahasiswa_' . substr(md5(uniqid()), 0, 5) . '.pdf';
        $pdfFilePath = $pdfDirectory . $pdfFileName;

        if (!is_dir($pdfDirectory)) {
            mkdir($pdfDirectory, 0777, true);
        }


        // Buat tampilan HTML untuk PDF
        $html = '<html>';
        $html .= '<head>';
        $html .= '<style>';
        $html .= '.bg-danger { background-color: #dc3545; color: white; }';
        $html .= '.bg-success { background-color: #28a745; color: white; }';
        $html .= '.kop { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 20px; }'; // Gaya kop
        $html .= '.tandatangan { text-align: right; font-size: 12px; margin-top: 30px; }';
        $html .= '.nip { text-align: right; font-size: 12px;  }';
        $html .= '.gelar { text-align: right; font-size: 12px;  }';
        $html .= '.custom-table { width: 100%; border-collapse: collapse; }'; // Menggunakan border-collapse: collapse untuk menggabungkan border
        $html .= '.custom-table, .custom-table th, .custom-table td { border: 1px solid black; padding: 5px; font-size: 10px; }'; // Ukuran teks
        $html .= '.custom-table th { background-color: #f2f2f2; border: 1px solid black; }'; // Mengatur border pada header
        $html .= '.custom-table .bg-danger { background-color: #dc3545; color: white; }';
        $html .= '.custom-table .bg-success { background-color: #28a745; color: white; }';
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body>';

        // Header kop surat dengan tabel
        $html .= '<table style="width: 100%; text-align: center;">';
        $html .= '<tr>';
        $imagePath = '/assets/images/polinela.png'; // Path relatif ke gambar
        $html .= '<td><img src="' . $_SERVER['DOCUMENT_ROOT'] . $imagePath . '" alt="Logo" style="max-width: 100px; height: auto;"/></td>';
        $html .= '<td>';
        $html .= '<h2 style="font-weight: lighter;">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h2>';
        $html .= '<h3>POLITEKNIK NEGERI LAMPUNG</h3>';
        $html .= '<h5 style="font-weight: lighter;">Jl. Soekarno Hatta No. 10 Rajabasa Bandar Lampung</h5>';
        $html .= '<h5 style="font-weight: lighter;">Telepon (0721) 703995 Faksimili (0721) 787309 </h5>';
        $html .= '<h5 style="font-weight: lighter;">Laman : <a href="http://www.polinela.ac.id" target="_blank">www.polinela.ac.id</a></h5>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '<hr>';

        // Konten utama
        $html .= '<h2 style="font-weight: lighter; text-align: center;">Laporan Mahasiswa</h2>';
        $html .= '<table class="custom-table">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>NPM</th>';
        $html .= '<th>Nama</th>';
        $html .= '<th>No Handphone</th>';
        $html .= '<th>Tanggal Lahir</th>';
        $html .= '<th>Semester</th>';
        $html .= '<th>Program Studi</th>';
        $html .= '<th width="10%">Dokumen</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $i = 1;
        foreach ($dataMahasiswa as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $i++ . '</td>';
            $html .= '<td>' . $row['npm'] . '</td>';
            $html .= '<td>' . $row['nama'] . '</td>';
            $html .= '<td>' . $row['no_hp'] . '</td>';
            $html .= '<td>' . $row['tgl_lahir'] . '</td>';
            $html .= '<td>' . $row['semester'] . '</td>';
            $html .= '<td>' . $row['prodi'] . '</td>';
            $html .= '<td>';
            $html .= '<span class="badge ' . (($row['dokumen'] == 'belum') ? 'bg-danger' : 'bg-success') . '">' . $row['dokumen'] . '</span>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Tanggal dan Tandatangan
        $today = new \DateTime();
        $dateFormatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
        $tanggalHariIni = $dateFormatter->format($today);

        $html .= '<div class="tandatangan">Bandar Lampung, ' . $tanggalHariIni . '</div>';
        $html .= '<div class="gelar">Wakil Direktur III</div>';
        $html .= '<br>';
        $html .= '<br>';
        $html .= '<div class="tandatangan">' . session('user')['nama'] . '</div>';
        $html .= '<div class="nip"> NIP ' . session('user')['nip'] . '</div>';
        $html .= '</body>';
        $html .= '</html>';


        // Tambahkan tampilan HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF ke file
        $mpdf->Output($pdfFilePath, 'F'); // 'F' untuk menyimpan ke file

        // Setelah menyimpan file, tambahkan logika untuk menyimpan data ke database
        $tanggalHariIni = date('Y-m-d'); // Ubah format tanggal sesuai dengan format di tabel database

        $dataLaporan = array(
            'tanggal' => $tanggalHariIni,
            'laporan' => $pdfFileName,
            'val_kabag' => 'Belum',
            'val_kasubag' => 'Belum'
            // tambahkan kolom lain sesuai dengan kebutuhan
        );

        $this->laporan->insert($dataLaporan);

        // Setelah menyimpan, tambahkan code untuk memberikan response file ke user
        return redirect()->to('wadir/laporan')->with('success', 'Laporan berhasil dibuat dan data laporan disimpan.');
    }

    public function delete($laporanId)
    {
        $laporan = $this->laporan->find($laporanId);

        if ($laporan) {
            $fileLaporanPath = FCPATH . 'assets/file/laporan/' . $laporan['laporan'];
            if (file_exists($fileLaporanPath)) {
                unlink($fileLaporanPath);
            }

            $this->laporan->delete($laporanId);

            return redirect()->to('wadir/laporan')->with('success', 'Laporan berhasil dihapus.');
        } else {
            return redirect()->to('wadir/laporan')->with('error', 'Laporan tidak ditemukan.');
        }
    }
}
