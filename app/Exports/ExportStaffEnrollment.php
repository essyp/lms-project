<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStaffEnrollment implements FromCollection, WithHeadings
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
        return Course::leftJoin('staff', function($join) {
            $join->on('courses.staff_id', '=', 'staff.id');
          })->whereBetween('courses.updated_at', [$this->request->from_date, $this->request->to_date,])
          ->select('staff.staff_no','staff.fullname','courses.name','courses.code','courses.updated_at')
          ->get();
    }

    public function headings() :array
    {
        return ["Staff ID", "Staff Name", "Course Name", "Course Code", "Date Created"];
    }
}