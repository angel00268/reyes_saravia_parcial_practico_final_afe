<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use PDF;
use App\Models\Check;
use App\Models\Document;
use App\Models\Product;
use App\Models\Seller;
use Jenssegers\Date\Date;
use Luecano\NumeroALetras\NumeroALetras;

class PDFController extends Controller
{

    public function index() {
        $products = Product::all();
        return view('landing.index', compact('products'));
    }

    public function auditorReport() {

        $products = Product::all();
        
        $pdf = PDF::loadView('PDF.auditor', compact('products'));
        return $pdf->stream('report-'.now().'.pdf');
    }

    public function sellerReport(){
        $sellers = Seller::all();
        $pdf = PDF::loadView('PDF.seller', compact('sellers'));
        return $pdf->stream('report-'.now().'.pdf');
    }

    public function parametrizadoReport(Request $request){
        $products = Product::where("seller_id","=",$request->seller_id);
        $pdf = PDF::loadView('PDF.param', compact('products'));
        return $pdf->stream('report-'.now().'.pdf');
    }

}
