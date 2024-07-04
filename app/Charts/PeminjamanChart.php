<?php

namespace App\Charts;
use App\Models\Peminjaman;
use App\Models\Pengunjung;
use App\Models\Buku;
use App\Models\Baca;
use App\Models\Kategori;
use Carbon\Carbon;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class PeminjamanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }


    public function buildPengunjungChart(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Ambil data peminjaman dari database dan hitung total per bulan
        $data = $this->getMonthlyPengunjungData();

        return $this->chart->lineChart()
            ->setTitle( ' Informasi Data Pengunjung')
            ->setSubtitle('Data Pengunjung Setiap Bulan')
            ->addData('Total Pengunjung', $data['totals'])
            ->setXAxis($data['months']);
    }

    public function buildPeminjamanChart(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Ambil data peminjaman dari database dan hitung total per bulan
        $data = $this->getMonthlyPeminjamanData();

        return $this->chart->BarChart()
            ->setTitle('    Informasi Data Peminjaman')
            ->setSubtitle('Data Peminjaman Setiap Bulan')
            ->addData('Total Peminjaman', $data['totals'])
            ->setXAxis($data['months']);
    }

    public function buildBukuChart($bulan = null): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // Ambil data jumlah peminjaman buku dari database berdasarkan bulan
        $data = $this->getBukuData($bulan);

        // Buat grafik lingkaran dengan LarapexCharts
        $chart = $this->chart->pieChart()
            ->setTitle('Data Peminjaman Berdasarkan Kategori')
            ->setSubtitle('Data dari Season 2021.')
            ->addData($data['totals'])
            ->setLabels($data['labels']);

        return $chart;
    }

    public function buildBacaChart($bulan = null): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // Ambil data jumlah peminjaman buku dari database berdasarkan bulan
        $data = $this->getBacaData($bulan);

        // Buat grafik lingkaran dengan LarapexCharts
        $chart = $this->chart->pieChart()
            ->setTitle(' Data Pembaca Berdasarkan Kategori')
            ->setSubtitle('Data dari Season 2021.')
            ->addData($data['totals'])
            ->setLabels($data['labels']);

        return $chart;
    }


    Private function getMonthlyPengunjungData()
{
    // Inisialisasi array bulan-bulan dan total peminjaman
    $months = [];
    $totals = [];

    // Ambil data peminjaman dari database
    $pengunjung = Pengunjung::selectRaw('COUNT(*) as total, MONTH(created_at) as month')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Inisialisasi nilai total peminjaman untuk setiap bulan menjadi nol
    for ($i = 1; $i <= 12; $i++) {
        $totals[$i] = 0;
        $months[$i] = Carbon::create()->month($i)->format('F');
    }

    // Isi total peminjaman sesuai dengan data yang diperoleh dari database
    foreach ($pengunjung as $data) {
        $totals[$data->month] = $data->total;
    }

    // Ubah array bulan-bulan dan total peminjaman ke dalam format yang sesuai
    $months = array_values($months);
    $totals = array_values($totals);

    // Format total peminjaman tanpa koma ribuan
    $totals = array_map(function ($total) {
        return number_format($total, 0);
    }, $totals);

    return ['months' => $months, 'totals' => $totals];
}


    private function getMonthlyPeminjamanData()
{
    // Inisialisasi array bulan-bulan dan total peminjaman
    $months = [];
    $totals = [];

    // Ambil data peminjaman dari database
    $peminjaman = Peminjaman::selectRaw('COUNT(*) as total, MONTH(tanggal_pinjam) as month')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Inisialisasi nilai total peminjaman untuk setiap bulan menjadi nol
    for ($i = 1; $i <= 12; $i++) {
        $totals[$i] = 0;
        $months[$i] = Carbon::create()->month($i)->format('F');
    }

    // Isi total peminjaman sesuai dengan data yang diperoleh dari database
    foreach ($peminjaman as $data) {
        $totals[$data->month] = $data->total;
    }

    // Ubah array bulan-bulan dan total peminjaman ke dalam format yang sesuai
    $months = array_values($months);
    $totals = array_values($totals);

    // Format total peminjaman tanpa koma ribuan
    $totals = array_map(function ($total) {
        return number_format($total, 0);
    }, $totals);

    return ['months' => $months, 'totals' => $totals];
}
private function getBukuData($bulan = null)
{
    // Query awal untuk memilih data peminjaman buku berdasarkan kategori
    $query = Peminjaman::leftJoin('kategoris', 'peminjamen.kategori_id', '=', 'kategoris.id')
        ->selectRaw('kategoris.nama as nama_kategori, COUNT(*) as total');

    // Jika bulan diberikan, tambahkan kondisi WHERE untuk memfilter berdasarkan bulan
    if ($bulan) {
        $query->whereRaw('MONTH(peminjamen.tanggal_pinjam) = ?', [$bulan]);
    }

    // Kelompokkan berdasarkan nama kategori
    $query->groupBy('kategoris.nama');

    // Ambil data peminjaman
    $peminjaman = $query->get();

    // Inisialisasi array untuk menyimpan jumlah peminjaman per kategori
    $totalsPerKategori = [];

    // Loop melalui data peminjaman untuk mengumpulkan jumlah peminjaman per kategori
    foreach ($peminjaman as $pem) {
        // Simpan jumlah peminjaman per kategori
        $totalsPerKategori[$pem->nama_kategori] = $pem->total;
    }

    // Ambil nama kategori untuk label
    $labels = array_keys($totalsPerKategori);

    // Ambil jumlah peminjaman untuk data chart
    $totals = array_values($totalsPerKategori);

    return ['labels' => $labels, 'totals' => $totals];
}
private function getBacaData($bulan = null)
{
    // Query awal untuk memilih data peminjaman buku berdasarkan kategori
    $query = Baca::leftJoin('kategoris', 'baca.kategori_id', '=', 'kategoris.id')
        ->selectRaw('kategoris.nama as nama_kategori, COUNT(*) as total');

    // Jika bulan diberikan, tambahkan kondisi WHERE untuk memfilter berdasarkan bulan
    if ($bulan) {
        $query->whereRaw('MONTH(baca.pembaca) = ?', [$bulan]);
    }

    // Kelompokkan berdasarkan nama kategori
    $query->groupBy('kategoris.nama');

    // Ambil data peminjaman
    $baca = $query->get();

    // Inisialisasi array untuk menyimpan jumlah peminjaman per kategori
    $totalsPerKategori = [];

    // Loop melalui data peminjaman untuk mengumpulkan jumlah peminjaman per kategori
    foreach ($baca as $pem) {
        // Simpan jumlah peminjaman per kategori
        $totalsPerKategori[$pem->nama_kategori] = $pem->total;
    }

    // Ambil nama kategori untuk label
    $labels = array_keys($totalsPerKategori);

    // Ambil jumlah peminjaman untuk data chart
    $totals = array_values($totalsPerKategori);

    return ['labels' => $labels, 'totals' => $totals];
}
}
