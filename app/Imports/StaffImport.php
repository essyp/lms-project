<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Staff;
use App\Models\StaffRole;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class StaffImport implements ToCollection, WithHeadingRow, WithColumnFormatting
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
            $role = $row['staff_role'];
            $staff_role = StaffRole::where('name', 'LIKE', "%{$role}%")->first();
            if($staff_role){
                $role_id = $staff_role->id;
            } else {
                $staff_role = StaffRole::where('name', 'Teacher')->first();
                $role_id = $staff_role->id;
            }
                       
            $data = Staff::updateOrCreate(
                ['staff_no' => $row['staff_num'],'email' => $row['email']],[
                'staff_no' =>  $row['staff_num'],
                'ref' => 'RF-'.$this->unique_code(6),
                'role_id' =>  $role_id,
                'position' =>  $row['staff_position'],
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
                'title' => $row['title'],
            ]);
        }
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        // if(!(User::where('ref_id','LA-0001001')->first())){
        //     $ref_id='LA-0001001';
        // }
        // else{
        //     $number=User::get()->last()->ref_id;
        //     $number=str_replace('LA-',"",$number);
        //     $number=str_pad($number+1, 7, '0', STR_PAD_LEFT);
        //     $ref_id='LA-'.$number;
        // }
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