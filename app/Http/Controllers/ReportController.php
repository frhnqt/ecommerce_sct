<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesananModel;
use Barryvdh\DomPDF\Facade\Pdf;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReportController extends Controller
{
    public function indexlaporan()
    {
        return $this->showLaporan();
    }

    public function showLaporan()
    {
        $listpesanandiselesaikan = PesananModel::paginate(10);
        return view('datareport', compact('listpesanandiselesaikan'));
    }

    public function cetaklaporan(Request $request)
    {
        // Mengambil semua data pesanan
        $listpesanandiselesaikan = PesananModel::all(); 

        if ($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('pdf.cetaklaporan', compact('listpesanandiselesaikan'));
            return $pdf->download('Laporan Data.pdf');
        }

        return view('pdf.cetaklaporan', compact('listpesanandiselesaikan'));
    }
}
