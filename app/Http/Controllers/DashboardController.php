<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
protected $laporanService;
protected $stokService;

public function __construct(
    LaporanPenjualanService $laporanService,
    MonitoringStokService $stokService
) {
    $this->laporanService = $laporanService;
    $this->stokService = $stokService;
}
    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHarianIni();

        return view('dashboard',[
            'tanggalHariIni' => Carbon::now(),
            'ringkasan' => $ringkasan,
            'produkTerlaris' => $this->laporanService->produkTerlarisHariIni(),
            'produkStokRendah' => $this->stokService->produkStokRendah(),
            'produkStokHabis' => $this->stokService->produkStokHabis(),
        ]);
    }
}
