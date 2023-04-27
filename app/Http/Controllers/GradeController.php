<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportGrade;

class GradeController extends Controller
{
    public function exportData(Request $request)
    {
        return Excel::download(new ExportGrade(), 'grade.xlsx');
    }
}