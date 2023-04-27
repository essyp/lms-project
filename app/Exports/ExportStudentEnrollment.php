<?php

namespace App\Exports;

use App\Models\StudentEnrollment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStudentEnrollment implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($request)
    {
        $this->request = $request;
    }
    
    public function collection()
    {
        return StudentEnrollment::leftJoin('students', function($join) {
            $join->on('student_enrollments.student_id', '=', 'students.id');
          })->whereBetween('student_enrollments.created_at', [$this->request->from_date, $this->request->to_date,])
          ->select('students.student_no','students.fullname','student_enrollments.previous_class_code','student_enrollments.previous_class_name','student_enrollments.next_class_code','student_enrollments.next_class_name')
          ->get();
    }

    public function headings() :array
    {
        return ["Student ID", "Student Name", "Previous Class Code", "Previous Class Name", "Next Class Code","Next Class Name"];
    }
}