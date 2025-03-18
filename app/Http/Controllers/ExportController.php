<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export()
    {
        return response()->download('path_to_your_pdf_file.pdf');
    }
}
