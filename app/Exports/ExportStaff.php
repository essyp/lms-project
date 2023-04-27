<?php

namespace App\Exports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStaff implements FromCollection, WithHeadings
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
        return Staff::leftJoin('staff_roles', function($join) {
            $join->on('staff.role_id', '=', 'staff_roles.id');
          })->whereBetween('staff.created_at', [$this->request->from_date, $this->request->to_date,])
          ->select('staff.staff_no','staff_roles.name','staff.position','staff.first_name','staff.last_name','staff.middle_name','staff.email','staff.phone_number','staff.gender','staff.lga','staff.state','staff.address','staff.status')
          ->get();
    }

    public function headings() :array
    {
        return ["Staff ID", "Staff Role", "Staff Position", "First Name", "Last Name","Middle Name", "Email","Phone Number", "Gender", "LGA", "State","Address", "Status"];
    }
}