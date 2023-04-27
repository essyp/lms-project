<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Course;

class DashboardController extends Controller
{
    public function fetchData()
    {
        $students = Student::count();
        $staff = Staff::count();
        $course = Course::count();
        return view('index', compact('students','staff','course'));
    }
}