<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\StudentEnrollment;
use App\Models\ClassGroup;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EnrollmentImport implements ToCollection, WithHeadingRow, WithColumnFormatting
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
            $student = Student::where('student_no', $row['student_id'])->first();
                    
            $data = StudentEnrollment::updateOrCreate(
                ['student_no' => $row['student_id']],[
                'student_no' =>  $row['student_id'],
                'student_id' =>  $student->id,
                'previous_class_id' => $row['previous_id'],
                'previous_class_code' => $row['previous_code'],
                'previous_class_name' => $row['previous_name'],
                'next_class_id' => $row['next_id'],
                'next_class_code' => $row['next_code'],
                'next_class_name' => $row['next_name'],
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