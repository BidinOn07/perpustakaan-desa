<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use ConsoleTVs\Charts\Facades\Charts;
use App\Charts\PeminjamanChart;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PeminjamanChart $chart)
    {
        $data['chartPeminjaman'] = $chart->buildPeminjamanChart();
        $data['chartPengunjung'] = $chart->buildPengunjungChart();
        $data['chartBuku'] = $chart->buildBukuChart();
        $data['chartBaca'] = $chart->buildBacaChart();
        return view('home', $data);
    }
    // public function rpt()
    // {
    //     $chartPengunjung = Charts::database(User::all(), 'bar', 'highcharts')
    //         ->title("Pengunjung")
    //         ->elementLabel("Total")
    //         ->dimensions(1000, 500)
    //         ->responsive(false)
    //         ->groupByMonth(date('Y'), true);

    //     $chartBuku = Charts::create('pie', 'highcharts')
    //         ->title("Buku")
    //         ->labels(['Fiksi', 'Non-Fiksi', 'Edukasi'])
    //         ->values([5, 10, 20])
    //         ->dimensions(1000, 500)
    //         ->responsive(false);

    //     $chartPeminjaman = Charts::create('line', 'highcharts')
    //         ->title("Peminjaman")
    //         ->elementLabel("Total")
    //         ->dimensions(1000, 500)
    //         ->responsive(false)
    //         ->groupByMonth(date('Y'), true);

    //     return view('report', compact('chartPengunjung', 'chartBuku', 'chartPeminjaman'));
    // }

}
