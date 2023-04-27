<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStudents implements FromCollection, WithHeadings
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
        return Student::whereBetween('created_at', [$this->request->from_date, $this->request->to_date,])
        ->select('student_no','first_name','last_name','middle_name','email','phone_number','gender','parent_name','lga','state','address','status')
        ->get();
    }

    public function headings() :array
    {
        return ["Student ID", "First Name", "Last Name","Middle Name", "Email","Phone Number", "Gender", "Parent/Guardian","LGA", "State","Address", "Status"];
    }
}