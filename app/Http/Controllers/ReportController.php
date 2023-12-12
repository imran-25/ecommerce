<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function categoryReport()
    {
        $categories  = Category::all();

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->showWatermarkText = true;
        $mpdf->SetWatermarkText('PHP with Laravel Framework');


        $html = view('backend.categories.category_pdf', compact('categories'))->render();

        $mpdf->WriteHTML($html);
        
        $mpdf->Output('category.pdf','D');
 
       
    }

    public function categoryExcelReport()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }
}
