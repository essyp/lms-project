<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class StudentImport implements ToCollection, WithHeadingRow, WithColumnFormatting
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
           
        foreach ($rows as $row) {
            // Log::debug($row);       
                 
            $data = Student::updateOrCreate(
                ['student_no' => $row['student_id'],'email' => $row['email']],[
                'student_no' =>  $row['student_id'],
                'ref' => 'RF-'.$this->unique_code(6),
                'first_name' => $row['first_name'],
                'last_name' => $row['sur_name'],
                'middle_name' => $row['mid_name'],
                'fullname' => $row['first_name'].' '.$row['mid_name'].' '.$row['sur_name'],
                'phone_number' => $row['phone'],
                'email' => $row['email'],
                'address' => $row['address'],
                'lga' => $row['lga'],
                'state' => $row['state'],
                'gender' => $row['gender'],
                'parent_name' => $row['parent_guardian'],
            ]);
        }
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function columnFormats(): array
    {
        return [
            'phone' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}